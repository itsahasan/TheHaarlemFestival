<?php

require __DIR__ . '/../../services/tourguideservice.php';

class TourGuideController
{

    private $tourguideService;

    function __construct()
    {
        $this->tourguideService = new TourGuideService();
        session_start();
    }


    public function list()
    {

        $model = $this->tourguideService->getAll();
        require __DIR__ . '/../../views/cms/tourguide/index.php';
    }




    public function create(){

        require __DIR__ . '/../../views/cms/tourguide/create.php';

    }


    public function edit(){

        $id = htmlspecialchars($_GET["updateID"]);
        $updateTourguide = $this->tourguideService->getOne($id);
        require __DIR__ . '/../../views/cms/tourguide/edit.php';

    }

    public function store(){

        
        $name = htmlspecialchars($_POST["name"]);
        $description = htmlspecialchars($_POST["description"]);

        $tourguidescms = new TourGuide();

        $tourguidescms->setName($name);
        $tourguidescms->setDescription($description);

        if (count($_FILES) > 0) {
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {


                $uploadDir = __DIR__ . '/../../public/uploads/';

                
                $fieldName = 'image';

                $extension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
                $uniqueFilename = uniqid("img_") . '.' . $extension;
                $destination = $uploadDir . $uniqueFilename;


                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $publicUrl =  $uniqueFilename;

                if (move_uploaded_file($_FILES[$fieldName]['tmp_name'],  $destination)) {

                    $tourguidescms->setImage($this->tourguideService->saveImage($publicUrl));
                }


            }
        } else {
            echo "Problem Occured! ";
        }

        $this->tourguideService->addTourguide($tourguidescms);

        if ($this->tourguideService) {

            echo "<script>sessionStorage.setItem('success', 'Tour Guide added successfully'); window.location = '/admin/tourguide/list';</script>";
        } else {

            echo "<script>sessionStorage.setItem('success', 'Failed to add Tour Guide.'); window.location = '/admin/tourguide/list';</script>";
        }

    }


    public function update(){


        $name = htmlspecialchars($_POST["changedName"]);
        $description = htmlspecialchars($_POST["changedDescription"]);

        $tourguidescms = new TourGuide();

        $tourguidescms->setName($name);
        $tourguidescms->setDescription($description);

        $theTourguide = $this->tourguideService->getATourguide($_GET["updateID"]);
        
        if (count($_FILES) > 0) {
            
            if (isset( $_FILES['changeImage']['tmp_name']) && is_uploaded_file($_FILES['changeImage']['tmp_name'])) {


                if (is_uploaded_file($_FILES['changeImage']['tmp_name'])) {


                    $uploadDir = __DIR__ . '/../../public/uploads/';
    
                    
                    $fieldName = 'changeImage';
    
                    $extension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
                    $uniqueFilename = uniqid("img_") . '.' . $extension;
                    $destination = $uploadDir . $uniqueFilename;
    
    
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
    
                    $publicUrl =  $uniqueFilename;
    
                    if (move_uploaded_file($_FILES[$fieldName]['tmp_name'],  $destination)) {
    

                        $tourguidescms->setImage($this->tourguideService->updateImage($publicUrl, $theTourguide->getImage()));

                    }
    
    
                }
            }
        } else {
            echo "Problem Occured!";
        }

        $this->tourguideService->updateTourguide($tourguidescms, $_GET["updateID"]);

        if ($this->tourguideService) {

            echo "<script>sessionStorage.setItem('success', 'Tour Guide updated successfully! '); window.location = '/admin/tourguide/list';</script>";
        } else {
            echo "<script>sessionStorage.setItem('success', 'Failed to update Tour Guide.'); window.location = '/admin/tourguide/cms';</script>";
        }

    }



    public function delete(){


        $id = htmlspecialchars($_GET["deleteID"]);
        $this->tourguideService->deleteTourguide($id);

        if ($this->tourguideService) {

            echo "<script>sessionStorage.setItem('success', 'Tour Guide deleted successfully!'); window.location = '/admin/tourguide/list';</script>";

        } else {

            echo "<script>sessionStorage.setItem('error', 'Failed to delete Tour Guide.'); window.location = '/admin/tourguide/list';</script>";
        }
        
        
    }





}
