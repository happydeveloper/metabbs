<?php
require_once 'cores/feed.php';
render_feed('Full site feed', url_for('feed'), '',
		Site::get_latest_posts(10), 'atom');