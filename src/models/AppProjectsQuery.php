<?php

namespace portalium\device\models;

/**
 * This is the ActiveQuery class for [[AppProject]].
 *
 * @see AppProject
 */
class AppProjectsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppProject[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppProject|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
