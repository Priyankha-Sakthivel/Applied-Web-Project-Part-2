<!-- This page is the About page for the HireHub project. 
It provides information about the team members, their contributions, quotes, fun facts, and a group photo.
Some members were not present during some sessions, and thus a group photo will be a composite of individual photos. 
The page is structured with semantic HTML elements, including header, main, section, and footer. 
It also includes a navigation menu for easy access to other pages of the project. 
The content is organized into sections for team details, member contributions, quotes, group photo, and fun facts. 
Each section uses appropriate HTML elements such as lists, definition lists, blockquotes, figures, and tables to present the information clearly.	
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Meet the HireHub project team and learn about each member's contribution.">
	<title>About the Team | HireHub</title>
	<link rel="stylesheet" href="styles/styles.css">
	<style>
		/* Embedded CSS: gives each team member's quote a subtle background so it stands out */
		.about-page blockquote {
			background-color: #f4f7f9;
			padding: 10px 16px;
		}
	</style>
</head>
<body class="about-page">
	<header>
		<a href="index.html">
			<img src="Logo.png" width="100" alt="HireHub Logo">
		</a>
		<nav>
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="jobs.html">Job Description</a></li>
				<li><a href="apply.html">Apply</a></li>
				<li><a href="about.html" class="active" aria-current="page">About</a></li>
			</ul>
		</nav>
		<h1 style="letter-spacing: 0.5px;">About the Team</h1>
	</header>

	<main>
		<section class="team-details">
			<h2>Team Details</h2>
			<ul>
				<li>Group name:
					<ul>
						<li>WebDevs </li>
					</ul>
				</li>
				<li>Tutorial class:
					<ul>
						<li>Wednesday</li>
						<li>2:30pm-4:30pm</li>
					</ul>
				</li>
			</ul>
		</section>

		<section>
			<h2>Member Contributions</h2>
			<dl>
				<dt>Priyankha Sakthivel</dt>
				<dd>Apply page & corresponding CSS</dd>
				<dt>Dimitri Meric</dt>
				<dd>Home page & corresponding CSS</dd>
				<dt>Thomas Mathew</dt>
				<dd>Jobs Page & corresponding CSS</dd>
                <dt>Kevin Tan </dt>
				<dd>Apply Page & corresponding CSS</dd>
                <dt>Mark Leirum </dt>
				<dd>About Page & corresponding CSS</dd>
			</dl>
		</section>
		<section>
			<h2>Member Quotes</h2>
			<blockquote>
				<p>&ldquo;Work hard, play hard.&rdquo;</p>
				<cite>Priyankha Sakthivel</cite>
			</blockquote>
			<blockquote>
				<p>&ldquo;Arriver en avance est inacceptable, arriver à l'heure revient à être en retard, et arriver à la dernière minute, c'est être à l'heure.&rdquo;</p>
				<p>English translation: &ldquo;To be early is unacceptable to be on time is to be late and to be last minute is to be on time.&rdquo;</p>
				<cite>Dimitri Meric </cite>
			</blockquote>
			<blockquote>
				<p>&ldquo;If it works, don't ask too many questions.&rdquo;</p>
				<cite>Thomas Mathew </cite>
			</blockquote>
            			<blockquote>
				<p>&ldquo;大家好&rdquo;</p>
				<p>English translation: &ldquo;Hello Everyone.&rdquo;</p>
				<cite>Kevin Tan </cite>
			</blockquote>
            			<blockquote>
				<p>&ldquo;石の上にも三年(Ishi no ue ni mo san nen).&rdquo;</p>
				<p>English translation: &ldquo;Perseverance changes things.&rdquo;</p>
				<cite>Mark Leirum </cite>
			</blockquote>
		</section>
		<section>
			<h2>Meet the team</h2>
			<figure>
				<img src="group_photo.jpg" alt="WebDevs team group photo, photo collage of five members" width="900">
				<figcaption>WebDevs Group</figcaption>
			</figure>
		</section>
		
		<section>
			<h2>Fun Facts</h2>
			<table>
				<caption>Fun facts about the team</caption>
				<thead>
					<tr>
						<th scope="col">Member</th>
						<th scope="col">Fun fact</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">Priyankha Sakthivel</th>
						<td>Always has a book on the go.</td>
					</tr>
					<tr>
						<th scope="row">Dimitri Meric</th>
						<td>I'm french, you can make fun of me now</td>
					</tr>
					<tr>
						<th scope="row">Thomas Mathew </th>
						<td>Professional last-minute problem solver.</td>
					</tr>
                    					<tr>
						<th scope="row">Kevin Tan </th>
						<td>My left hand fingers are longer than my right.</td>
					</tr>
                    					<tr>
						<th scope="row">Mark Leirum </th>
						<td>Can either be found sleeping or running around, no inbetween.</td>
					</tr>
				</tbody>
			</table>
		</section>
	</main>

	<footer>
		<p>&copy; 2026 Tourism and Travel Technology Platform</p>
	</footer>
</body>
</html>
