<?php

use yii\bootstrap\Html;
?>
<div class="header">
    <div  style="position:relative">
        <a href="<?php echo \yii\helpers\Url::toRoute(['app/index']); ?>"><div class="logo"><img src="<?= APP_WEB; ?>images/icon1.png" alt=""></div></a>
        <div class="name"> <svg width="100%" height="50" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <line x1="0" y1="15" x2="0" y2="35" style="stroke:#ccc;stroke-width:3"/>
                <text x="10" y="30" font-size="13" style="fill:#4a4a4a">
                    <tspan font-family="KaiTi"> <?= Html::encode($this->title); ?></tspan>
                </text>
            </svg></div>
        <div class="nav-icon"><img src="<?= APP_WEB; ?>images/icon2.png" alt=""></div>

        <div class="nav" style="position:absolute; left:0px;  top:0px;">
            <ul>
                <li><a href="">学院简介</a>
                    <div>
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['intro/detail']); ?>">学院介绍</a></span>
        <!--                <span><a href="--><?php //echo \yii\helpers\Url::toRoute(['news/venture_competition']);                          ?><!--">创业大赛</a></span>-->
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['intro/index']); ?>">机构设置</a></span>
                    </div>
                </li>
                <li><a href="">动态信息</a>
                    <div>
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['news/index']); ?>">新闻动态</a></span>
        <!--                <span><a href="--><?php //echo \yii\helpers\Url::toRoute(['news/venture_competition']);                          ?><!--">创业大赛</a></span>-->
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['news/venture']); ?>">创业赛事</a></span>
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['policy/total_notice']); ?>">通知公告</a></span>
                    </div>
                </li>
                <li><a href="">校园创业</a>
                    <div>
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['campus/team']); ?>">创业团队</a></span>
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['good/teacher']); ?>">创业导师</a></span>
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['campus/org']); ?>">创业组织</a></span>
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['campus/invest']); ?>">投资公司</a></span>
                    </div>
                </li>
                <li><a href="">政策信息</a>
                    <div>
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['policy/notice']); ?>">政策公告</a></span>
        <!--                 <span><a href="<?php echo \yii\helpers\Url::toRoute(['policy/teacher']); ?>">教师科研成果转化</a></span> -->
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['policy/file']); ?>">相关文件</a></span>
                    </div>
                </li>
                <li><a href="">创业干货</a>
                    <div>
                    <!--       <span><a href="<?php echo \yii\helpers\Url::toRoute(['news/info']); ?>">最新文章</a></span> -->
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['app/lesson']); ?>">创业课程</a></span>
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['good/active']); ?>">精品活动</a></span>
                    </div>
                </li>
                <li><a href="">创业基地</a>
                    <div>
                      <!--    <span><a href="<?php echo \yii\helpers\Url::toRoute(['space/space_index']); ?>">众创空间</a></span>-->
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['space/index']); ?>">元空间</a></span>
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['space/science_index']); ?>">良渚科技园</a></span>
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['space/many_index']); ?>">杭州众创空间</a></span>
                        <span><a href="<?php echo \yii\helpers\Url::toRoute(['space/town_index']); ?>">紫金创业小镇</a></span>
                    </div>
                </li>
                <!--
              <li><a href="">成果转化</a>
                  <div>
                      <span><a href="<?php echo \yii\helpers\Url::toRoute(['policy/teacher']); ?>">专利转化</a></span>
                  </div>
              </li>
                -->
            </ul>
        </div>
    </div>
</div>

<!--==================导航==================-->