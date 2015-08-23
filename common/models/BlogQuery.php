<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Blog]].
 *
 * @see Blog
 */
class BlogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Blog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Blog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}