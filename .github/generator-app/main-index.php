<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
	  integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<link href="https:////cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>

<style>
	/*! normalize.css v3.0.2 | MIT License | git.io/normalize */
	@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,700");

	html {
		font-family: sans-serif;
		-ms-text-size-adjust: 100%;
		-webkit-text-size-adjust: 100%
	}

	body {
		padding: 0;
		margin: 0;
		font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
		font-size: 16px;
		line-height: 1.5;
		color: #606c71
	}

	a {
		color: #1e6bb8;
		text-decoration: none
	}

	a:hover {
		text-decoration: underline
	}


	.page-header {
		color: #fff;
		padding: 2rem 6rem;
		text-align: center;
		background-color: #159957;
		background-image: linear-gradient(120deg, #155799, #159957)
	}

	@media screen and (min-width: 64em) {
		.page-header {
			padding: 5rem 6rem
		}
	}

	@media screen and (min-width: 42em) and (max-width: 64em) {
		.page-header {
			padding: 3rem 4rem
		}
	}

	@media screen and (max-width: 42em) {
		.page-header {
			padding: 2rem 1rem
		}
	}

	.project-name {
		margin-top: 0;
		margin-bottom: 0.1rem
	}

	@media screen and (min-width: 64em) {
		.project-name {
			font-size: 3.25rem
		}
	}

	@media screen and (min-width: 42em) and (max-width: 64em) {
		.project-name {
			font-size: 2.25rem
		}
	}

	@media screen and (max-width: 42em) {
		.project-name {
			font-size: 1.75rem
		}
	}

	.project-tagline {
		margin-bottom: 2rem;
		font-weight: normal;
		opacity: 0.7
	}

	@media screen and (min-width: 64em) {
		.project-tagline {
			font-size: 1.25rem
		}
	}

	@media screen and (min-width: 42em) and (max-width: 64em) {
		.project-tagline {
			font-size: 1.15rem
		}
	}

	@media screen and (max-width: 42em) {
		.project-tagline {
			font-size: 1rem
		}
	}

	.page-header > h2 {
		margin-bottom: 0;
		margin-top: 10px
	}

</style>
<title>Personal URL Shortener / Redirector</title>
<section class="page-header">
	<h1 class="project-name">Personal URL Shortener / Redirector</h1>
</section>
<div class="container my-5">
	<div class="row">
		<div class="col-12">
			<table class="table  table-bordered table-striped">
				<thead class="thead-dark">
				<tr>
					<th style="width:45%;">To URL</th>
					<th>Redirect Options</th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ( $table_list as $url => $data ) {

					echo '<tr>';
					echo "<td><a href=\"${url}\" class='mb-2 d-block'>{$data['name']}</a> <code>${url}</code></td>";
					echo '<td><ul style="padding: 0;margin: 0;list-style: inside;padding-left: 10px;">';
					foreach ( $data['urls'] as $url ) {
						echo "<li><a href=\"${url}\">${url}</a></li>";
					}
					echo '</ul></td>';
					echo '</tr>';
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script
		src="https://code.jquery.com/jquery-3.5.1.min.js"
		integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
		crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.21/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.21/datatables.min.js"></script>
<script>
	$( document ).ready( function() {
		$( 'table' ).DataTable( {
			paging: false
		} );
	} );
</script>