<div class="workspace__container">
    <?php if (isset($post)): ?>
        <div class="container post__wrapper">
            <div class="post-logo">
                <a href="/post<?php echo $post->id; ?>">
                    <img src="<?php echo $post->image; ?>"
                         alt="<?php echo $post->title; ?>"
                         class="post-logo__image">
                </a>
                <div class="post-user">
                    <p class="post-user__name">
                        <?php echo $post->user->last_name . ' ' . $post->user->first_name; ?>
                    </p>
                    <p class="post-user__date">
                        <?php echo $post->created_at; ?>
                    </p>
                    <button class="btn btn-my post-user__phone"
                            onclick="alert('<?php echo $post->user->phone; ?>')">
                        <?php echo mb_substr($post->user->phone, 0, 3) . '. . . . . . .'; ?>
                    </button>
                </div>
            </div>
            <div class="post-info">
                <div class="post-info__title">
                    <span class="title"><?php echo $post->title; ?></span>
                    <span class="title">
                        <span class="post-info__price"><?php echo $post->price; ?></span> руб.
                    </span>
                </div>
                <div class="post-info__title">
                    <p class="title"><?php echo $post->category->name; ?></p>
                </div>
                <p class="post-info__description"><?php echo $post->description; ?></p>
                <div class="post-images">
                    <?php if (count($post->images) !== 0): ?>
                        <?php foreach ($post->images as $image): ?>
                            <img src="<?php echo $image->image; ?>"
                                 alt="<?php echo $post->title; ?>"
                                 data-toggle="modal"
                                 class="thumb">
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container_fluid">
            <div class="flex-center">
                <div class="message">
                    <div class="title mb-2">У Вас нет объявлений</div>
                    <a href="/posts/create" class="btn">Добавить</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
