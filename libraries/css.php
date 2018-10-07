<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="libraries/css/fontawesome-all.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<style type="text/css">
.pushdown70px {
	padding-bottom: 70px;
}
img {
	display: block;
	max-width: 100%;
	height: auto;
}
.issue-done {
	background: linear-gradient(#def4d7, white);
}

/*
 * Sidebar
 */

.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  right: 0;
  z-index: 100; /* Behind the navbar */
  padding: 70px 0 0; /* Height of navbar */
  padding-right: 10px;
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: .5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

@supports ((position: -webkit-sticky) or (position: sticky)) {
  .sidebar-sticky {
    position: -webkit-sticky;
    position: sticky;
  }
}


/*
 * Content
 */

[role="main"] {
  padding-top: 70px; /* Space for fixed navbar */
}
</style>