<?php
namespace Application\Controllers;

use Application\Core\Controller;
use Application\Core\Database;
use Application\Models\ErrorModel;
use Application\Views\ErrorView;
use Application\Views\GoodView;

/**
 * Class GoodController
 *
 * @package Application\Controllers
 */
class GoodController extends Controller
{
    /**
     * @param array $server
     * @param array $request
     * @param array $session
     */
    public function action(array $server, array $request, array $session)
    {
        $uri = explode("/", $server['REQUEST_URI']);
        $id = array_pop($uri);
        if ($id) {
            $details = Database::getInstance()->query("SELECT * FROM item WHERE id = {$id}");
            $data['title'] = $details[0]['title'];
            $data['media'] = $this->getImage($details[0]['media_id']);
            $data['description'] = $details[0]['description'];
            $data['price'] = $details[0]['price'];
        }


        (new GoodView())->generate($data);
    }

    public function getImage($mediaId)
    {
        $media = Database::getInstance()->query("SELECT * FROM media WHERE id = {$mediaId}");
        if ($media) {
            return 'data:image/*;base64,' . $media[0]['media'];
        } else {
            return 'data:image/*;base64,' . base64_encode(file_get_contents(__DIR__ . '/../../public/img/no_image.png'));
        }
    }
}