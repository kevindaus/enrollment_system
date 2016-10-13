<?php 

use yii\widgets\Breadcrumbs;

?>
<?php if (isset($this->params['breadcrumbs'])): ?>
 <!-- Page breadcrumb -->
 <section id="mu-page-breadcrumb">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="mu-page-breadcrumb-area">
           <h2><?= $this->title ?></h2>
            <?= Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- End breadcrumb -->
<?php endif ?>