<?php

namespace portalium\device\models;

/**
 * This is the ActiveQuery class for [[TblTourTagAssn]].
 *
 * @see TblTourTagAssn
 */
class TblTourTagAssnQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TblTourTagAssn[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TblTourTagAssn|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
