<?php

namespace portalium\device\models;

/**
 * This is the ActiveQuery class for [[DeviceTags]].
 *
 * @see DeviceTags
 */
class DeviceTagsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DeviceTags[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DeviceTags|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
