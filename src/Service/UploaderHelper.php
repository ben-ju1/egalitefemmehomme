<?php


namespace App\Service;


use App\Entity\Piano;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Asset\Context\RequestStackContext;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class UploaderHelper
{
    //    Constante qui pointe directement vers le fichier source d'images (à changer si changement vers cloud...)

    const FOLDER_UPLOADS = 'uploads/article_image/';

    private $requestStackContext;


    public function __construct(RequestStackContext $requestStackContext)
    {
        $this->requestStackContext = $requestStackContext;
    }

    // Twig Extension "uploaded_asset" qui permet de pointer directement vers le folder d'image

    public function getImagePath($content)
    {
        return $this->requestStackContext->getBasePath() . '/' . self::FOLDER_UPLOADS . $content;
    }

    public function uploadFile($uploadedFile)
    {
        if ($uploadedFile === null) {
            return false;
        }
        $destination = self::FOLDER_UPLOADS;

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

        $newFileName = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

        $uploadedFile->move($destination, $newFileName);

        return $newFileName;
    }

    public function deleteFile(Piano $piano)
    {
        $filesystem = new Filesystem();

        if ($piano->getImage() !== "" && $filesystem->exists(UploaderHelper::FOLDER_UPLOADS . $piano->getImage())) {

            $filesystem->remove(UploaderHelper::FOLDER_UPLOADS . $piano->getImage());
            return true;
        }
        return new Response("Aucune image n'a été supprimé.", 200);
    }
}