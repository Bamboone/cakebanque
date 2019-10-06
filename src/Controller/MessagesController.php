<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 *
 * @method \App\Model\Entity\Message[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $user_id = $this->Auth->user('id');
        $requete = $this->Messages->find('all');
        if($this->Auth->user('role') != 'admin'){
            $requete->matching('Users', function ($q) use ($user_id) {
                return $q->where(['Users.id' => $user_id]);
            });
        }
        $messages = $this->paginate($requete);

        $this->set(compact('messages'));
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('message', $message);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('Le message a été sauvegardé.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le message n\'a pas pu être sauvegardé. Veuillez réessayez.'));
        }
        $users = $this->Messages->Users->find('list', ['limit' => 200, 'valueField' => 'username']);
        $this->set(compact('message', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('Le message a été sauvegardé.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le message n\'a pas pu être sauvegardé. Veuillez réessayez.'));
        }
        $users = $this->Messages->Users->find('list', ['limit' => 200, 'valueField' => 'username']);
        $this->set(compact('message', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('Le message a été supprimé.'));
        } else {
            $this->Flash->error(__('Le message n\'a pas pu être supprimé. Veuillez réessayez.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if ($user['role'] === 'admin') {
            return true;
        } else {
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
        }
    }
}
