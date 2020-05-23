<?php

namespace portalium\device\models;

/**
 * This is the ActiveQuery class for [[ProjectAppRelation]].
 *
 * @see ProjectAppRelation
 */
class ProjectAppRelationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectAppRelation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectAppRelation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
