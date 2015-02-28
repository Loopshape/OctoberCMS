# Blog Video plugin

This plugin extends the [RainLab Blog plugin](/plugin/rainlab-blog) with the responsive video embedding features. The plugin was tested with Vimeo and YouTube videos, but in theory it can be used with any video service which uses iframes for embedding.

## Adding video to a post

Use the following syntax to insert a video placeholder to a blog post:

    ![1](video)

The number in the first part is the placeholder index. If you use multiple videos in a post you should use unique indexes:

    ![1](video)

    ![2](video)

## Styling the responsive videos

The plugin adds a wrapping DIV element around the embedded iframe element. The wrapper allows to make the video responsive, fit the containing column and maintain the aspect ratio.

    <div class="video-wrapper ratio-16-9"><iframe ...></iframe></div>

Add the following CSS code to your website in order to support the video wrapper:

    .video-wrapper {
        position: relative;
        padding-top: 25px;
        margin-bottom: 15px;
        height: 0;
    }

    .video-wrapper.ratio-5-4 {padding-bottom: 80%;}
    .video-wrapper.ratio-4-3 {padding-bottom: 70%;}
    .video-wrapper.ratio-16-10 {padding-bottom: 62.5%;}
    .video-wrapper.ratio-16-9 {padding-bottom: 56.25%;}

    .video-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%!important;
        height: 100%!important;
    }