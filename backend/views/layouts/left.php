<?php

/**
 * Created by getpu on 16/8/19.
 */

use getpu\mgmt\models\Tree;

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="http://zuohao.oss-cn-hangzhou.aliyuncs.com/back/hb-logo.png?r=g&s=64" class="img-circle"/>
            </div>
            <div class="pull-left info">
                <p>
                    <span class="fa fa-user"></span>
                    <span><?= ucfirst(Yii::$app->user->identity->username) ?></span>
                </p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?php
        echo getpu\lte\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            // 'items' => \yii\helpers\ArrayHelper::merge($favouriteMenuItems, $menuItems),
            'items' => Tree::makeTree(Tree::findOne(['name' => '后台模块'])->children(1)),
        ]);
        ?>

    </section>

</aside>