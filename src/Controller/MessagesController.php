<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

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
        /*        'fields' => [
                    'id', 'name', 'description'
                ],
        */        'sortWhitelist' => [
            'id', 'titre', 'message'
        ]
    ];

    /*public function beforeRender(Event $event) {
        $users = $this->Messages->Users->find('list', ['limit' => 200, 'valueField' => 'username']);
        $user_id = $this->Auth->user('id');
        $requete = $this->Messages->find('all');
        if($this->Auth->user('role') != 'admin'){
            $requete->matching('Users', function ($q) use ($user_id) {
                return $q->where(['Users.id' => $user_id]);
            });
        }
        $messages = $this->paginate($requete);
        $this->set(compact('users', 'messages'));
    }*/



    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if ($user['role'] === 'admin') {
            return true;
        } else if ($user['active'] == 1){
            if (in_array($action, ['index'])) {
                return true;
            }

            // Toutes les autres actions nécessitent un utilisateur connecté
            $id = $this->request->getParam('pass.0');
            if (!$id) {
                return false;
            }
            // On vérifie que le message appartient à l'utilisateur connecté
            $message = $this->Messages->findById($id) -> contain(['Users']) -> first();
            $trouve = false;
            $listeUsers = $message->users;
            foreach ($listeUsers as $users):

                if($users->get('id') === $user['id']){
                    $trouve = true;
                }
            endforeach;
            return $trouve;
        }else{
            return false;
        }

    }
}
