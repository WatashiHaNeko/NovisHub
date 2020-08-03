<?php
declare(strict_types=1);

namespace App\Module\SoftDelete;

use ArrayObject;
use Cake\ORM\Query as CakeQuery;

class Query extends CakeQuery {
  public function triggerBeforeFind(): void {
    if (!$this->_beforeFindFired && $this->_type === 'select') {
      $this->_beforeFindFired = true;

      $repository = $this->getRepository();

      if (!isset($this->_options['withDeleted'])) {
        $this->andWhere([sprintf('%s IS', $repository->aliasField('deleted')) => null]);
      }

      $repository->dispatchEvent('Model.beforeFind', [
        $this,
        new ArrayObject($this->_options),
        !$this->isEagerLoaded(),
      ]);
    }
  }
}

