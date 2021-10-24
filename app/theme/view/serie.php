<?php require PATH . '/theme/view/common/header.php';?>
<div class="app-detail flex-fill">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo APP.'/series'?>">
                    <?php echo __('Series');?></a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo $Listing['title'];?>
            </li>
        </ol>
    </nav>
    <?php echo ads($Ads,3,'mb-3');?>
    <div class="row">
        <div class="col-md-3">
            <div class="media media-cover mb-2" data-src="<?php echo UPLOAD.'/cover/'.$Listing['image'];?>"></div>
                <?php if($Listing['trailer']) { ?>
                <button type="button" class="btn btn-theme px-5 my-3 mr-2 trailer" data-toggle="modal" data-target="#lg" data-remote="<?php echo APP.'/modal/trailer?trailer='.urlencode($Listing['trailer']);?>">
                    <?php echo __('Trailer');?></button>
                <?php } ?>
        </div>
        <div class="col-md-9">
            <div class="pl-md-4">
                <h1>
                    <?php echo $Listing['title'];?>
                </h1>
<?php if($Listing['title_sub']) { ?><?php echo __('Also Known As');?>: <h2 style="display:inline;"><?php echo $Listing['title_sub'];?></h2><br /><?php } ?>
            	<a href="<?php echo $_SERVER['REQUEST_URI']; echo '-1-season-1-episode'; ?>"><button type="button" class="btn btn-theme px-5 my-3 mr-2">
                	Watch Now</button></a>
                    <?php if($Listing['imdb']) { ?>
                    <div class="video-attr">
                        <div class="attr">
                            <?php echo __('IMDB');?>
                        </div>
                        <div class="text">
                            <?php echo $Listing['imdb'];?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($Listing['country_name']) { ?>
                    <div class="video-attr">
                        <div class="attr">
                            <?php echo __('Country');?>
                        </div>
                        <div class="text">
                			<?php $self = str_replace(' ', '-', strtolower($Listing['country_name'])); ?>
                        	<a href="<?php echo APP . '/country/' . $self; ?>"><?php echo $Listing['country_name'];?></a>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="video-attr">
                        <div class="attr">
                            <?php echo __('Genre');?>
                        </div>
                        <div class="text">
                    <?php foreach ($Categories as $Category) { ?>
                    <a href="<?php echo APP.'/series/'.$Category['self'];?>">
                        <?php echo $Category['name'];?></a>
                    <?php } ?>
                        </div>
                    </div>
                <?php if($Listing['mpaa']) { ?>
                <div class="video-attr">
                    <div class="attr">
                        <?php echo __('MPAA');?>
                    </div>
                    <div class="text">
                        <?php echo $Listing['mpaa'];?>
                    </div>
                </div>
                <?php } ?>
                    <?php if($Listing['duration']) { ?>
                    <div class="video-attr">
                        <div class="attr">
                            <?php echo __('Duration');?>
                        </div>
                        <div class="text">
                            <?php echo $Listing['duration'].' '.__('min');?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($Listing['create_year']) { ?>
                    <div class="video-attr">
                        <div class="attr">
                            <?php echo __('Release Date');?>
                        </div>
                        <div class="text">
                            <?php echo $Listing['create_year'];?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($Listing['end_year']) { ?>
                    <div class="video-attr">
                        <div class="attr">
                            <?php echo __('End Date');?>
                        </div>
                        <div class="text">
                            <?php echo $Listing['end_year'];?>
                        </div>
                    </div>
                    <?php } ?>
                <?php if(count($Actors) > 0) { ?>
                <div class="video-attr">
                    <div class="attr">
                        <?php echo __('Actors');?>
                    </div>
                    <div class="text" data-more="" data-element="a" data-limit="6">
                        <?php foreach ($Actors as $Actor) { ?>
                        <a href="<?php echo actor($Actor['actor_id'],$Actor['self']);?>">
                            <?php echo $Actor['name'];?>
                        </a>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <?php if($Listing['description']) { ?>
                <div class="video-attr">
                    <div class="attr">
                        <?php echo __('Overview');?>
                    </div>
                    <div class="text">
                        <div class="text-content">
                        <?php echo $Listing['description'];?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if($Data['tags']) { ?>
                <div class="tags" data-more="" data-element="div" data-limit="6">
                    <?php 
                        $Tags = explode(',', $Data['tags']);
                        for ($i=0; $i <count($Tags); $i++) { 
                        ?>
                    <div>
                        <?php echo $Tags[$i];?>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <div class="nav-social">
                    <?php foreach ($Data['social'] as $key => $value) { ?>
                    <?php if($value) { ?>
                    <a href="<?php echo 'https://www.'.$key.'.com/'.$value;?>" target="_blank" title="<?php echo $key;?>">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#'.$key;?>" />
                        </svg>
                    </a>
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <?php echo ads($Ads,1,'my-3');?>
            <?php 
                // Season
                $Seasons = $this->db->from(null,'
                    SELECT 
                    posts_season.id,  
                    posts_season.name
                    FROM `posts_season`
                    WHERE posts_season.content_id = "'.$Listing['id'].'"
                    ORDER BY cast(name as unsigned) ASC')
                ->all(); 
            ?>
            <?php if(count($Seasons)>0) { ?>
            <div class="season-list">
                <div class="seasons">
                    <ul class="nav" role="tablist">
                        <?php 
                        $i=0;
                        foreach ($Seasons as $Season) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if($i == 0) echo 'active';?>" id="season-<?php echo $Season['name'];?>-tab" data-toggle="tab" href="#season-<?php echo $Season['name'];?>" role="tab" aria-controls="season-<?php echo $Season['name'];?>" aria-selected="<?php echo ($i == 0 ? 'true' : 'false');?>">
                                <?php echo __('Season').' '.$Season['name'];?></a>
                        </li>
                        <?php $i++; } ?>
                    </ul>
                </div>
                <div class="episodes tab-content">
                    <?php 
                    $i=0; 
                    foreach ($Seasons as $Season) { 
                    ?>
                    <div class="tab-pane <?php echo ($i == 0 ? 'show active' : '');?>" id="season-<?php echo $Season['name'];?>" role="tabpanel" aria-labelledby="season-<?php echo $Season['name'];?>-tab">
                        <?php 

                            // Episodes
                            $Episodes = $this->db->from(null,'
                                SELECT 
                                posts_episode.id,  
                                posts_episode.name,  
                                posts_episode.description,  
                                posts_episode.created
                                FROM `posts_episode`
                                WHERE posts_episode.status = "1" AND posts_episode.content_id = "'.$Listing['id'].'" AND posts_episode.season_id = "'.$Season['id'].'"
                                ')
                            ->all(); 
                            foreach ($Episodes as $Episode) { 
                            ?>
                        <a href="<?php echo episode($Listing['id'],$Listing['self'],$Season['name'],$Episode['name']);?>">
                            <div class="episode">
                        		<?php echo __('Episode').' '.$Episode['name'];?>
                            </div>
                            <div class="name">
                                <?php echo $Episode['description'];?>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                    <?php $i++; } ?>
                </div>
            </div>
            <?php } ?>
            <?php if($Listing['comment'] != 1) { ?>
            <div class="row">
                <div class="col">
                    <?php require PATH . '/theme/view/common/comments.php';?>
                </div>
                <?php if(ads($Ads,4,'ml-auto')) { ?>
                <div class="col-md-4">
                    <?php echo ads($Ads,4,'ml-auto');?>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php require PATH . '/theme/view/common/schema.serie.php';?>
<?php require PATH . '/theme/view/common/footer.php';?>
