<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    protected function onGetUserFilesList($fileType)
    {
        $files = [];
        $directory_path = ROOTPATH . 'public/uploads';
        $directory = new \DirectoryIterator($directory_path);

        $user_id = session()->get('user_id');
        $isAdministrator = UserModel::isAdministrator($user_id);

        $getType = function ($fileType, $file) {
            if ($fileType == 'image') {
                return $this->isImage($file->getExtension());
            } else if ($fileType == 'document') {
                return $this->isDocument($file->getExtension());
            }
        };

        foreach ($directory as $file) {
            if ($file->isFile() && $getType($fileType, $file)) {
                $file_name = $file->getFilename();
                $split_name = explode('@', $file_name);
                $file_user_id = $split_name[0];

                if ($isAdministrator || $user_id == $file_user_id) {
                    $files[] = $file->getFilename();
                }
            }
        }

        return $files;
    }

    protected function isImage($extension)
    {
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

        return in_array(strtolower($extension), $allowedExts);
    }

    protected function isDocument($extension)
    {
        $documents = ['docx', 'xlsx', 'pdf'];

        return in_array($extension, $documents);
    }
}