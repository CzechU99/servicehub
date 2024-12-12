<?php

namespace App\Controller;

use App\Entity\Obserwowane;
use App\Entity\Uslugi;
use App\Form\AddServiceFormType;
use App\Repository\UslugiRepository;
use App\Form\SzybkieSzukanieFormType;
use App\Repository\KategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DaneUzytkownikaRepository;
use App\Repository\ObserwowaneRepository;
use App\Repository\RezerwacjeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserServiceController extends AbstractController
{
    #[Route('/service_view/{idUslugi}', name: 'app_service_view')]
    public function register(
        int $idUslugi,
        UslugiRepository $uslugi,
        Request $request,
        EntityManagerInterface $entityManager,
        ObserwowaneRepository $obserwowane,
    ): Response
    {

      $usluga = $uslugi->find($idUslugi);

      $path = 'zdjeciaUslug/' . $usluga->getUzytkownik()->getId() . '/' . $idUslugi;  

      $wszystkiePliki = scandir($path);
      $nazwyZdjec = [];

      foreach ($wszystkiePliki as $plik) {
          if (in_array(pathinfo($plik, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
              $nazwyZdjec[] = $plik;
          }
      }

      $session = $request->getSession();
      $viewedServices = $session->get('viewed_services', []);

      if (!in_array($usluga->getId(), $viewedServices, true)) {
        $usluga->incrementWyswietlenia();
        $entityManager->persist($usluga);
        $entityManager->flush();

        $viewedServices[] = $usluga->getId();
        $session->set('viewed_services', $viewedServices);
      }

      $form = $this->createForm(SzybkieSzukanieFormType::class);

      $obserwowanePrzezUzytkownika = $obserwowane->findBy(['uzytkownik' => $this->getUser()->getId(), 'usluga' => $usluga]);

      return $this->render('userservice/service_view.html.twig', [
        'szybkieSzukanieForm' => $form->createView(),
        'usluga' => $usluga,
        'zdjecia' => $nazwyZdjec,
        'obserwowane' => $obserwowanePrzezUzytkownika,
      ]);
      
    }

    #[Route('/add_edit_service/{idUslugi?}', name: 'app_add_edit_service')]
    #[IsGranted('ROLE_USER')]
    public function addEditService(
      EntityManagerInterface $entityManager,
      DaneUzytkownikaRepository $daneUzytkownika,
      Request $request,
      KategorieRepository $kategorie,
      UslugiRepository $uslugiRepository,
      ?int $idUslugi = null
    ): Response {

      if (!$daneUzytkownika->findOneBy(['uzytkownik' => $this->getUser()])) {
        $this->addFlash('error', 'Aby korzystać w pełni z platformy, najpierw uzupełnij swoje dane.');
        return $this->redirectToRoute('app_profile');
      }

      $user = $this->getUser();
      $userId = $user->getId();

      $categories = $kategorie->findAll();

      $usluga = $idUslugi ? $uslugiRepository->findOneBy([
        'id' => $idUslugi,
        'uzytkownik' => $userId,
      ])
      : new Uslugi();

      $form = $this->createForm(AddServiceFormType::class, $usluga, [
          'categories' => $categories,
      ]);

      $form->handleRequest($request);

      $existingImages = [];
      if ($idUslugi !== null) {
          $serviceFolder = $this->getParameter('kernel.project_dir') . '/public/zdjeciaUslug/' . $userId . '/' . $idUslugi;
          if (is_dir($serviceFolder)) {
              $files = array_diff(scandir($serviceFolder), ['.', '..']);
              foreach ($files as $file) {
                $existingImages[] = '/servicehub/public/zdjeciaUslug/' . $userId . '/' . $idUslugi . '/' . $file;
              }
          }
      }

      if ($form->isSubmitted() && $form->isValid()) {

        if($idUslugi){
        
          $query = $entityManager->getConnection()->prepare('
              DELETE FROM kategorie_uslugi
              WHERE uslugi_id = :uslugaId
          ');

          $query->bindValue(':uslugaId', $idUslugi);
          $query->executeQuery();

        }

        $publicDir = $this->getParameter('kernel.project_dir') . '/public';
        $userFolder = $publicDir . '/zdjeciaUslug/' . $userId;

        if (!is_dir($userFolder)) {
          mkdir($userFolder, 0777, true);
        }

        if($idUslugi) {
          $serviceFolder = $userFolder . '/' . $usluga->getId();

          if (is_dir($serviceFolder)) {
            $files = glob($serviceFolder . '/*'); 
            foreach ($files as $file) {
              if (is_file($file)) {
                unlink($file); 
              }
            }
          } else {
              mkdir($serviceFolder, 0777, true);
          }
        } else {
          $usluga->setUzytkownik($user);
          $usluga->setDataDodania(new \DateTime());
          $usluga->setWyswietlenia(0);
          $entityManager->persist($usluga);
          $entityManager->flush();

          $serviceFolder = $userFolder . '/' . $usluga->getId();
          if (!is_dir($serviceFolder)) {
            mkdir($serviceFolder, 0777, true);
          }
        }

        $uploadedFiles = $request->files->get('add_service_form')['images'];
        if ($uploadedFiles) {
          foreach ($uploadedFiles as $index => $file) {
            if ($file->isValid() && $file->getSize() <= 5 * 1024 * 1024) {
              $originalName = $file->getClientOriginalName();
              $cleanName = preg_replace('/^[\d_]+/', '', $originalName);
              $filename = sprintf('%d_%s', $index + 1, $cleanName);
              if ($index == 0) {
                $usluga->setGlowneZdjecie($filename);
              }
              $file->move($serviceFolder, $filename);
            }
          }
        }

        $selectedCategories = $form->get('kategorie')->getData();

        foreach ($selectedCategories as $category) {
          $usluga->addKategorie($category);
          $category->addUslugaKategorium($usluga); 
        }

        $entityManager->persist($usluga);
        $entityManager->flush();

        $this->addFlash('success', 'Usługa została dodana!');
        return $this->redirectToRoute('app_myservices');

      }

      return $this->render('userservice/add_edit_service.html.twig', [
        'dodajUslugeForm' => $form->createView(),
        'isEdit' => $idUslugi !== null,
        'existingImages' => $existingImages,
      ]);
    }


    #[Route('/delete_service/{idUslugi}', name: 'app_delete_service')]
    #[IsGranted('ROLE_USER')]
    public function deleteService(
        int $idUslugi,
        UslugiRepository $uslugi,
        RezerwacjeRepository $rezerwacje,
        EntityManagerInterface $entityManager,
    ): Response
    {

      $user = $this->getUser();
      $userId = $user->getId();

      $uslugaDoUsuniecia = $uslugi->findOneBy([
        'id' => $idUslugi,
        'uzytkownik' => $this->getUser(), 
      ]);

      $idUslugaDoUsuniecia = $uslugaDoUsuniecia->getId();

      $queryBuilder = $rezerwacje->createQueryBuilder('u')
        ->where('(u.uslugaDoRezerwacji = :usluga AND u.czyPotwierdzona = 1)')
        ->orWhere('(u.uslugaNaWymiane = :usluga AND u.czyPotwierdzona = 1)')
        ->setParameter('usluga', $idUslugaDoUsuniecia);

      $powiazaneUslugi = $queryBuilder->getQuery()->getResult();

      dump($idUslugaDoUsuniecia);
      dump($powiazaneUslugi);

      if($powiazaneUslugi){
        $this->addFlash('error', 'Nie możesz usunąć usługi, która ma potwierdzoną rezerwację!');
        return $this->redirectToRoute('app_myservices');
      }else{
        $queryBuilder = $rezerwacje->createQueryBuilder('u')
          ->where('(u.uslugaDoRezerwacji = :usluga)')
          ->orWhere('(u.uslugaNaWymiane = :usluga)')
          ->setParameter('usluga', $idUslugaDoUsuniecia);

        $rezerwacjeDoUsuniecia = $queryBuilder->getQuery()->getResult();
      }

      $publicDir = $this->getParameter('kernel.project_dir') . '/public';
      $sciezkaDoUsuniecia = $publicDir . '/zdjeciaUslug' . '/' . $userId . '/' . $idUslugaDoUsuniecia;

      if(is_dir($sciezkaDoUsuniecia)){
        $this->deleteFolder($sciezkaDoUsuniecia);
      }

      foreach($rezerwacjeDoUsuniecia as $rezerwacjaDoUsuniecia){
        $entityManager->remove($rezerwacjaDoUsuniecia);
        $entityManager->flush();
      }

      $entityManager->remove($uslugaDoUsuniecia);
      $entityManager->flush();
      
      $this->addFlash('success', 'Usługa została usunięta!');
      return $this->redirectToRoute('app_myservices');
      
    }

    private function deleteFolder(string $folderPath): void
    {
        $files = array_diff(scandir($folderPath), ['.', '..']);
        foreach ($files as $file) {
            $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;
            if (is_dir($filePath)) {
                $this->deleteFolder($filePath);
            } else {
                unlink($filePath);
            }
        }
        rmdir($folderPath);
    }

}
