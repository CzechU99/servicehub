<?php

namespace App\Controller;

use App\Entity\DaneUzytkownika;
use App\Entity\Uslugi;
use App\Form\AddServiceFormType;
use App\Repository\UslugiRepository;
use App\Form\SzybkieSzukanieFormType;
use App\Repository\KategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DaneUzytkownikaRepository;
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
        UslugiRepository $uslugi
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

      $form = $this->createForm(SzybkieSzukanieFormType::class);

      return $this->render('userservice/service_view.html.twig', [
        'szybkieSzukanieForm' => $form->createView(),
        'usluga' => $usluga,
        'zdjecia' => $nazwyZdjec
      ]);
      
    }

    #[Route('/add_edit_service/{idUslugaEdit?}', name: 'app_add_edit_skill')]
    #[IsGranted('ROLE_USER')]
    public function addEditService(
        EntityManagerInterface $entityManager,
        DaneUzytkownikaRepository $daneUzytkownika,
        Request $request,
        KategorieRepository $kategorie,
        ?int $idUslugaEdit = null
    ): Response
    {

      if(!$daneUzytkownika->findOneBy(['uzytkownik' => $this->getUser()])){
        $this->addFlash('error', 'ABY KORZYSTAĆ W PEŁNI Z PLATFORMY NAJPIERW UZUPEŁNIJ SWOJE DANE');
        return $this->redirectToRoute('app_profile');
      }

      $categories = $kategorie->findAll();

      $usluga = new Uslugi();

      $form = $this->createForm(AddServiceFormType::class, $usluga, [
        'categories' => $categories
      ]);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          
            $user = $this->getUser();
            $userId = $user->getId();

            $publicDir = $this->getParameter('kernel.project_dir') . '/public';
            $userFolder = '/zdjeciaUslug' . '/' . $userId;
            $folderPath = $publicDir . '/' . $userFolder;
            if (!is_dir($folderPath)) {
                mkdir($userFolder, 0777, true);
            }

            $usluga->setUzytkownik($user);
            $usluga->setDataDodania(new \DateTime());
            $entityManager->persist($usluga);
            $entityManager->flush();

            $serviceId = $usluga->getId(); 

            $serviceFolder = $folderPath . '/' . $serviceId;
            if (!is_dir($serviceFolder)) {
                mkdir($serviceFolder, 0777, true);
            }

            $uploadedFiles = $request->files->get('add_service_form')['images'];
            if ($uploadedFiles) {
                foreach ($uploadedFiles as $index => $file) {
                    if ($file->isValid() && $file->getSize() <= 5 * 1024 * 1024) { 
                      $filename = sprintf('%d_%s', $index + 1, $file->getClientOriginalName());
                      if($index == 0){
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

            return $this->redirectToRoute('app_myservices');

      }

      return $this->render('userservice/add_skill.html.twig', [
          'dodajUslugeForm' => $form->createView()
      ]);

    }

    #[Route('/delete_service/{idUslugi}', name: 'app_delete_service')]
    #[IsGranted('ROLE_USER')]
    public function deleteService(
        int $idUslugi,
        UslugiRepository $uslugi,
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

      $publicDir = $this->getParameter('kernel.project_dir') . '/public';
      $sciezkaDoUsuniecia = $publicDir . '/zdjeciaUslug' . '/' . $userId . '/' . $idUslugaDoUsuniecia;

      if(is_dir($sciezkaDoUsuniecia)){
        $this->deleteFolder($sciezkaDoUsuniecia);
      }

      $entityManager->remove($uslugaDoUsuniecia);
      $entityManager->flush();
      
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
