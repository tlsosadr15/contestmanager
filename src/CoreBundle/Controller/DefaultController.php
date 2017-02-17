<?php
/**
 * DefaultController file
 *
 * PHP Version 7
 *
 * @category Controller
 * @package  CoreBundle\Controller
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * DefaultController class
 *
 * @category Controller
 * @package  CoreBundle\Controller
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
class DefaultController extends Controller
{
    /**
     * tournament action
     *
     * @return RedirectResponse
     */
    public function tournamentAction()
    {
        return new RedirectResponse('/');
    }

    /**
     * Mobile app action
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function mobileAppUploadAction(Request $request)
    {
        $form = $this->createFormBuilder()
          ->add('app', FileType::class)
          ->getForm();

        if ($request->isMethod('GET')) {
            return $this->render('CoreBundle:Default:app_upload.html.twig', array('form' => $form->createView()));
        }
        foreach ($request->files as $uploadedFile) {
            $file = $uploadedFile['app'];

            $directory = $this->container->get('kernel')->getRootDir().'/../web/upload';
            if (!is_dir($directory)) {
                mkdir($directory);
            }
            $file->move($directory, 'ContestManager.'.$file->getClientOriginalExtension());
        }

        return $this->render('CoreBundle:Default:app_upload.html.twig', array(
              'success' => 'File uploaded',
              'form' => $form->createView(),
        ));
    }

    /**
     * Mobile app action
     *
     * @return BinaryFileResponse
     */
    public function mobileAppDownloadAction()
    {
        return $this->render('CoreBundle:Default:app_download.html.twig');
    }

    /**
     * Mobile app action
     *
     * @return BinaryFileResponse
     */
    public function appDownloadAction()
    {
        $filePath = $this->container->get('kernel')->getRootDir().'/../web/upload/ContestManager.apk';
        $response = new BinaryFileResponse($filePath);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'ContestManager.apk');

        return $response;
    }
}
