<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Transactions Controller
 *
 * @property \App\Model\Table\TransactionsTable $Transactions
 *
 * @method \App\Model\Entity\Transaction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransactionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Comptes']
        ];
        $transactions = $this->paginate($this->Transactions);

        $this->set(compact('transactions'));
    }

    /**
     * View method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Comptes']
        ]);

        $this->set('transaction', $transaction);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transaction = $this->Transactions->newEntity();
        if ($this->request->is('post')) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('La transaction a été sauvegardé.'));
                $compte = $this->Transactions->Comptes->get($transaction['compte_id']);
                $compte->balance = $compte['balance'] + $transaction['montant'];
                $this->Transactions->Comptes->save($compte);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La transaction n\'a pas pu être sauvegardé. Veuillez réessayez.'));
        }
        $comptes = $this->Transactions->Comptes->find('list', ['limit' => 200]);
        $this->set(compact('transaction', 'comptes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Comptes']
        ]);
        $compte = $transaction->compte;
        $compte->balance -= $transaction['montant'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('La transaction a été sauvegardé.'));

                $compte->balance += $transaction['montant'];
                $this->Transactions->Comptes->save($compte);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La transaction n\'a pas pu être sauvegardé. Veuillez réessayez.'));
        }
        $comptes = $this->Transactions->Comptes->find('list', ['limit' => 200]);
        $this->set(compact('transaction', 'comptes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Comptes']
        ]);
        $compte = $transaction->compte;
        if ($this->Transactions->delete($transaction)) {
            $this->Flash->success(__('La transaction a été supprimé.'));
            $compte->balance -= $transaction['montant'];
            $this->Transactions->Comptes->save($compte);
        } else {
            $this->Flash->error(__('La transaction n\'a pas pu être supprimé. Veuillez réessayez.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function findProvenances(){
        if ($this->request->is('ajax')) {

            $this->autoRender = false;
            $name = $this->request->query['term'];
            $this->loadModel('Provenances');
            $results = $this->Provenances->find('all', array(
                'conditions' => array('Provenances.name LIKE ' => '%' . $name . '%')
            ));

            $resultArr = array();
            foreach ($results as $result) {
                $resultArr[] = array('label' => $result['name'], 'value' => $result['name']);
            }
            echo json_encode($resultArr);
        }
    }

    public function isAuthorized($user)
    {
    if($user['role'] === 'admin'){
        return true;
    }else{
        return false;
    }


}
}
