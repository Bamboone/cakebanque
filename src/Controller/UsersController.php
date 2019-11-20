<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;
use Cake\Mailer\Email;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Comptes']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->uuid = Text::uuid();
            if ($this->Users->save($user)) {
                $this->envoieEmail($user['email'], $user['uuid']);
                if(!$this->request->getSession()->read('Auth.User')){
                    $this->Auth->setUser($user);
                }
            }else{
                $this->Flash->error(__('L\'utilisateur n\'a pas pu être sauvegardé, veuillez réessayer.'));
            }

        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Comptes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('L\'utilisateur a été sauvegardé.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('L\'utilisateur n\'a pas pu être sauvegardé, veuillez réessayer.'));
        }
        $comptes = $this->Users->Comptes->find('list', ['limit' => 200]);
        $this->set(compact('user', 'comptes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('L\'utilisateur a été supprimé.'));
            $userEnSession = $this->request->getSession()->read('Auth.User');
            if($userEnSession['id'] == $user['id']){
                $this->logout();
            }

        } else {
            $this->Flash->error(__('L\'utilisateur n\'a pas pu être supprimé, veuillez réessayer.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if($user['active'] == 0){
                    $this->Flash->error(__('Vous n\'avez pas confirmé votre adresse courriel, la majorité des fonctionnalités du site sont alors indisponibles. Vous avez seulement accès aux informations de votre compte utilisateur. Un bouton est disponible ci-dessous pour envoyer le lien à nouveau si vous ne l\'avez pas recu.'));
                    return $this->redirect(['action' => 'confirmationEmail']);
                }
                return $this->redirect($this->Auth->redirectUrl());

            }
            $this->Flash->error(__('Votre identifiant ou votre mot de passe est incorrect'));
        }
    }

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout', 'confirm', 'confirmationEmail', 'envoieEmail']);
        $user_id = $this->Auth->user('id');
        if($user_id == null){
            $this->Auth->allow(['add']);
        }
    }

    public function logout()
    {
        $this->Flash->success(__('Vous avez été déconnecté.'));
        return $this->redirect($this->Auth->logout());
    }

    public function envoieEmail($user_email, $user_uuid){
        $email = new Email('default');
        $confirmation_link = "http://" . $_SERVER['HTTP_HOST'] . $this->request->webroot . "users/confirm/" . $user_uuid;
        $email->to($user_email)->subject('Confirmation du compte Banque Web')->send($confirmation_link);
        $this->Flash->success(__('Un lien de confirmation a été envoyé.'));
        return $this->redirect(['action' => 'confirmationEmail']);
    }

    public function confirmationEmail(){

    }

    public function confirm($user_uuid){
      $user = $this->Users->find('all')->where(['uuid' => $user_uuid])->first();
      $user['active'] = 1;
      if ($this->Users->save($user)) {
          $this->Flash->success(__('Votre compte est maintenant confirmé! Veuillez vous reconnecter pour avoir accès à votre compte.'));
          $this->Auth->logout();
          return $this->redirect(['action' => 'login']);
      }

    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        $id = $this->request->getParam('pass.0');

        if(in_array($action, ['add'])){
            return false;
        }else if($user['role'] === 'admin'){
            return true;
        }else if(in_array($action, ['view', 'delete']) && $user['id'] == $id){
            return true;
        }else if($user['active'] == 1){

            if (in_array($action, ['index'])) {
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }


    }
}
