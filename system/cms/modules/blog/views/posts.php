<!-- Page Title -->
		<div class="section section-breadcrumbs">
			<div class="row">
				<div class="col-md-12">
					<h1>Beritax</h1>
				</div>
			</div>
		</div>
		
        <!-- Posts List -->
        <div class="section blog-posts-wrapper">
	    	<div class="container">
	    		<div class="row">
	    			<div class="col-md-8">
						{{ if posts }}

							{{ posts }}
						
								<div class="post">
						
									<h3><a href="{{ url }}">{{ title }}</a></h3>
						
									<div class="meta">
						
									<div class="date">
										{{ helper:lang line="blog:posted_label" }}
										<span>{{ helper:date timestamp=created_on }} | Hits : {{ hits }}</span>
									</div>
						
									{{ if category }}
									<div class="category">
										{{ helper:lang line="blog:category_label" }}
										<span><a href="blog/category/{{ category:slug }}">{{ category:title }}</a></span>
									</div>
									{{ endif }}
						
									{{ if keywords }}
									<div class="keywords">
										{{ keywords }}
											<span><a href="blog/tagged/{{ keyword }}">{{ keyword }}</a></span>
										{{ /keywords }}
									</div>
									{{ endif }}
						
									</div>
						
									<div class="preview">
									{{ preview }}
									</div>
						
									<p><a href="{{ url }}">{{ helper:lang line="blog:read_more_label" }}</a></p>
						
								</div>
						
							{{ /posts }}
							<div class="pagination-wrapper ">
							{{ pagination }}
							</div>
						{{ else }}
							
							{{ helper:lang line="blog:currently_no_posts" }}
						
						{{ endif }}
					</div>
					<div class="col-md-4 blog-sidebar">
						{{ widgets:area slug="sidebar-berita" }}
					</div>
	    		</div>
			</div>
	    </div>
	    <!-- End Posts List -->
		
