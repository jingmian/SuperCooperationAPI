<?php
/**
 * Created by PhpStorm.
 * User: suqian
 * Date: 14-9-16
 * Time: 下午4:18
 */

namespace App\Utils\NoSql\Redis\Table;

use App\Utils\NoSql\Redis\Entity\Set;
use App\Utils\NoSql\Redis\Entity\SortedSet;
use App\Utils\NoSql\Redis\RedisException;
use App\Utils\NoSql\Redis\Store;

class SHashTable extends Store{

    /**
     * Redis Set 数据类型对象
     * @var SortedSet
     */
    protected $redisSet;

    /**
     * @param $pk
     * @param array $attribute
     * @return string
     * @throws RedisException
     */
    public function  insert($pk,array $attribute)
    {
        if(empty($attribute)){
            throw new  RedisException('字段不存在');
        }
        if(null == $pk){
            $pk = $this->count();
            $attribute['redis_id'] = $pk;
        }
       $hash = $this->getRedisHash($pk);
       $hashKey = $hash->getKey();
       $set =  $this->getRedisSet();
       $flag = $set->add($hashKey);
       if($flag <= 0){
           throw new RedisException("hashkey [{$hashKey}]已经存在");
       }
       $hash->delete();
       foreach ($attribute as $field=>$value){
           $hash->save($field,$value);
       }
       if($this->expire > 0){
           $hash->expire($this->expire);
           $set->expire($this->expire);
       }
       return $hashKey;

    }

    public function save($pk,array $attribute){
        if(empty($attribute)){
            throw new RedisException('字段不存在');
        }
        if(null == $pk){
            $pk = $this->count();
        }
        $hash = $this->getRedisHash($pk);
        $hashKey = $hash->getKey();
        $set =  $this->getRedisSet();
        $set->add($hashKey);
        foreach ($attribute as $field=>$value){
            $hash->save($field,$value);
        }
        if($this->expire > 0){
            $hash->expire($this->expire);
            $set->expire($this->expire);
        }
        return $hashKey;
    }

    public function update($pk ,array $attribute){
        $hash = $this->getRedisHash($pk);
        if($hash->exist()){
            foreach($attribute as $field=>$value){
                $hash->save($field,$value);
            }
            return true;
        }
        return false;
    }

    public function findByPk($pk){
        $hash = $this->getRedisHash($pk);
        return $hash->getAllField();

    }

    public function findAll(){
        $hash = $this->getRedisHash(null);
        $set =  $this->getRedisSet();
        $rows = array();
        $_datas= $set->getData();
        if(!$_datas) return $rows;
        foreach($_datas as $_data){
            $rows[$_data] = $hash->getFieldByKey($_data);
            if(empty($rows[$_data])){
                $set->remove($_data);
            }
        }
        return $rows;
    }

    public function delete($pk){
        $hash = $this->getRedisHash($pk);
        $hashKey = $hash->getKey();
        $set =  $this->getRedisSet();
        if($hash->delete()){
             return $set->remove($hashKey);
        }
        return false;
    }

    public  function deleteAll(){
        $hash = $this->getRedisHash(null);
        $set =  $this->getRedisSet();
        if($rows = $hash->getRedisConnection()->delete($set->getData())){
              $set->getRedisConnection()->delete($set->getKey());
        }
        return $rows;
    }

    public function  count(){
        return $this->getRedisSet()->count();
    }


    /**
     * @param Set $redisSet
     */
    public function setRedisSet($redisSet){
        $this->redisSet = $redisSet;
    }

    /**
     * @return Set
     */
    public function getRedisSet(){
        if ($this->redisSet === null) {
            $this->redisSet = new Set($this->getRedisConnection());
        }
        $this->redisSet->setKey($this->getCommonKey());
        return $this->redisSet;
    }

    public   function  findByPage($page,$pageSize=20,$sorted ='asc'){

    }

    public   function  contains($pk){
        return $this->getRedisSet()->contains($this->getRedisKey($pk));
    }
}
