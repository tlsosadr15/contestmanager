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
use Symfony\Component\HttpFoundation\RedirectResponse;

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

}
