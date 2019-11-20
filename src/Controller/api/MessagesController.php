<?php
namespace App\Controller\api;

use App\Controller\api\AppController;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 *
 * @method \App\Model\Entity\Message[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{
    public $paginate = [
        'page' => 1,
        'limit' => 100,
        'maxLimit' => 150,
        'sortWhitelist' => [
            'id', 'titre', 'message'
        ]
    ];
}
