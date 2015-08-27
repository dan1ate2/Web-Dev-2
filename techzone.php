<!DOCTYPE html>
<html lang="en">
	<head>
		<title>DVD'sy - TechZone</title>
		<meta charset="utf-8">
		<meta name="description" content="DVD'sy movie rentals - TechZone articles">
		<!-- Common 'head' content -->
		<?php include 'includes/head.php' ?>
		<!-- end of Common 'head' content -->
	</head>

	<body>
		<!-- Header & Navigation -->
		<?php include 'includes/header-nav.php' ?>
		<!-- end of Header & Navigation -->

		<div class="container">
			<h1 class="page-title">TechZone</h1>
			<div class="left-box bg-opacity">
				<h2 class="orange">Dan the 'tech-x-pert'</h2>
					<p>Hi I'm Dan, I'm here to give you advice on all things tech.</p><br>
					<p>I have a solid I.T. background and started with computers at a very young age.</p><br>
					<p>I enjoy both the front-end and back-end of web development and enjoy a little graphic design on the side.</p><br>
					<p>Check out my articles below!</p>
			</div>
			<div class="right-box bg-opacity">
				<h2 class="black-orange">Dan</h2>
				<img src="images/dan.jpg" class="center-align" height="350" width="252" alt="dan">
			</div>
			<div class="clear"></div>
			<div class="fw-row">
				<br><h2 class="orange">Apache 2 vs IIS 7.5/8.5</h2>
				<div class="article bg-opacity">
					<p>Apache and IIS (Internet Information Services) are two of the most popular web server applications used today, and in this article I will compare the two and recommend which one is best to use for your business.</p>
					<p>Apache is freely distributed 'open source' software which means it's maintained and developed by an open community consisting of developers, while IIS is privately developed and owned by Microsoft Corporation.</p>
					<p>While Apache has been the 'most common web server on the internet since April 1996', IIS has been catching up over the past years as well as a newcomer called Nginx.</p>
						<div class="italic-references">[http://news.netcraft.com/archives/2014/02/07/are-there-really-lots-of-vulnerable-apache-web-servers.html]</div>
					<p>It's estimated that over half of the worlds active sites use Apache, somewhere around 91 million sites compared to 21 million for Microsoft (IIS), although there has been a recent shift in the last year where Microsoft began leading in the amount of hostnames.</p>
					<p>According to Netcraft.com.au, in July 2014, 'Microsoft's growth in hostnames has for the most part been caused by a large number of Chinese link-farms advertising gambling sites normally using affiliate schemes'.</p>
						<div class="italic-references">[http://news.netcraft.com/archives/2014/07/31/july-2014-web-server-survey.html]</div>
					<p>This basically means that although Microsoft has overtaken Apache in terms of the amount of hostnames using IIS, this isn’t necessarily a worthy metric to consider as these hostnames are not actively maintained sites by humans who would otherwise want to work with the best, most suitable and usable system for their needs. </p>
					<p>One benefit of using Apache over IIS is that because it is open source it means there are no licensing fees, and it has the flexibility factor in that the code can be modified and is constantly improved by a community of developers.  Another factor is that security is quite good, and because it's developed for an operating system (usually Linux) outside of Microsoft's operating systems and software that are constantly attacked with malicious programs, there appears to be lesser chance of security issues with Apache.</p>
					<p>A fall-back for the system is the fact it is a process-based server, meaning that a separate thread is required for each simultaneous connection, which means much more overhead and a slower system.</p>
						<div class="italic-references">[http://www.scriptrock.com/articles/iis-apache]</div>
					<p>IIS 8 on the other hand supports asynchronous programming techniques enabled by the Microsoft .NET Framework 4.5.</p>
						<div class="italic-references">[http://redmondmag.com/articles/2012/08/15/microsoft-touts-iis-8-improvements.aspx]</div>
					<p>Unfortunately because Apache is open source it means that there is no direct corporate support, but rather, relying on the developer community and forums to find help when the documentation isn't quite enough to solve a problem.</p>
					<p>IIS is supported by Microsoft who as most of us know are big, and have been around for years.  As a positive, Microsoft provides their customers with tech support. This is great for inexperienced users who may not be able to get by with just the documentation and trying to understand it, or hoping that someone in the developer community will have the right answer, which is your only choice with Apache.</p>
					<p>If you own a large business with a lot of sensitive assets to protect, you need to consider who will be taking care of things when a problem arises.  Would you be comfortable jeopardising your company's assets relying on a developer community whom could really be just about anyone?  Financially, it’s also far less expensive for a business to seek help through the software vender's tech support than to utilise their own staff and pay them for the time it takes them to figure out a problem, or find someone who can.</p>
					<p>IIS also supports modules or plug-ins (like Apache), and in version 8 Microsoft have added extra features that make their software quite competitive. One of these is the 'throttling' capabilities, where users can specify CPU load percentages, and also assess available CPU resources when determining the load. This is great as it means you can potentially reduce bandwidth costs by controlling the rate that media is delivered, and can split the bandwidth for each user without dropping below a set bit rate.</p>
						<div class="italic-references">[http://www.iis.net/downloads/microsoft/bit-rate-throttling]</div>
					<p>In-depth diagnostic tools are available in IIS 7.5/8.5 which include 'failed request tracing' and monitoring. Failed request tracing is an advanced way to log web pages and applications beyond the normal and basic text file logging. Using this you are able to focus on failed requests and their particular HTTP status codes, filtering specific filenames and file types.  File types are not limited to Microsoft types such as .asp and .aspx but also .php which is also supported in IIS. </p>
					<p>To potentially improve a client's experience on your website, you can utilise another module called 'advanced logging' which allows real-time analytics of client interaction with media content. This means a business can help improve the user experience and has the potential then to improve their ROI.</p>
					<p>The .NET framework is supported in IIS and has many advantages including cross-language interoperability which is the ability to use a preferred programming language while utilizing code from another. This works by the compilers following CLS (Common Language Specification) standards.</p>
					<p>The .NET framework supports object-oriented languages which are much easier and more efficient for developers as they can re-use and recycle code using techniques including polymorphism. Simplified application development is what .NET is all about.</p>
					<p>Although IIS supports PHP (Apache's language), Microsoft's cloud operating system called Azure can actually create virtual machines that run Linux for example, which is what Apache commonly uses. This means you can potentially have and use both systems on the same physical server. </p>
					<p>According to Microsoft, '57% of Fortune 500 companies are using Azure', and a reason for this could be the increase in security features to Azure. Although Apache has had a good reputation for its security, it seems Microsoft is constantly pushing the boundaries and providing their customers with excellent features such as Azure Site Recovery which replicates on-premises virtual machines to Azure, which can then be recovered if a problem arises.</p>
						<div class="italic-references">[http://motifworks.com/microsoft-57-of-fortune-500-companies-using-azure/]</div>
					<p>The main disadvantage of IIS is that it must be installed on a Microsoft operating system which unlike Apache must be purchased, however, as mentioned earlier it does support PHP. Another point is that IIS is commonly blamed for being slower in performance overall compared to Apache. There are now faster alternatives including newcomers Nginx on the rise too, but we will dig into that one in a future article.</p>
					<p>Let’s compare the costs associated with Apache 2 and IIS 7.5/8.5. 
					Since IIS is actually free but requires a Windows operating system, we will compare the costs of the 2 supporting systems, Windows Server 2012 and Azure.</p>
					<p>For Microsoft Azure, there are several options from a no commitment shared environment pay-as-you-go plan to virtual machines and also data storage and management. It's hard to give solid prices as it really depends on how much your business will use, and Microsoft does provide a pricing calculator to estimate costs for you. </p>
					<p>For purely websites in a shared environment (some rounding on costs):</p>
					<ul>
						<li>It's free to run up to 10 websites per region in a multi-tenant environment, and just shy of $100 per 10 websites with the extra custom domain support per month </li>
						<li>Costs around $12 p/m (per month) for 100GB of bandwidth</li>
						<li>General support is free, Developer support is $37p/m, Standard support is $382 p/m and Professional Direct support is around $1,280 p/m</li>
					</ul>
					<div class="italic-references">[http://azure.microsoft.com/en-us/pricing/calculator/?scenario=web]</div>
					<p>For Virtual Machines, the costs begin at $15p/m for the very basic (shared virtual cores with 768mb RAM) to $470p/m for an extra-large system (8 virtual cores, 14GB RAM). For a heavier workload and larger/multiple application systems, the 'Memory Intensive Instances' option starts at $250p/m (2 virtual cores, 14gb RAM) to about $1000p/m (8 cores, 56GB RAM).</p>
					<p>For the absolute bees knees the 'Compute Intensive Instances' option starts at $1,840p/m (8 virtual cores, 56GB RAM, 40Gbit/s network speed) to $3,769p/m (16 virtual cores, 112GB RAM, 40Gbit/s network speed).</p> 
						<div class="italic-references">[http://azure.microsoft.com/en-us/pricing/details/virtual-machines/]</div>
					<p>As for Linux and Apache, this is obviously free upfront but there are costs associated that are difficult to measure. These costs are to do with staff and developer training in maintaining and installation of the system, and will either comprise of employing I.T. staff or contracting from a third-party. These costs add up quickly and if your applications etc are very complex, this could potentially be a financial burden in the long run.</p>
					<p>In my opinion if you're serious about your business needs and security (and financial expenditure down the track) then IIS 7.5/8.5 is the way to go. The costs associated with installing a Windows operating system for using IIS, and all the added services and so forth, might make it seem like Apache would be a better option (since it's free).  In contrast though it's far more beneficial to pay upfront than having to hire full time I.T. staff to maintain an open source system without dedicated support.</p>
					<p>With only the slightly slower (rumoured) performance and upfront costs the only main disadvantages of using IIS, it really makes up for it with the tech support, newly upgraded security and vast number of features like in-depth diagnostic tools and support for .NET.</p>
					<p>IIS truly is the best option for your business, and I'm sure the 57% of Fortune 500 companies using it would agree.</p>
					<div class="orange-text" style="text-align:center;"><p>Bibliography</p></div>
					<ul>
						<li>Netcraft, February 2014 Web Server Survey, accessed 29 July 2015, [http://news.netcraft.com/archives/2014/02/07/are-there-really-lots-of-vulnerable-apache-web-servers.html]</li>
						<li>Netcraft 2014, July 2014 Web Server Survey, accessed 29 July 2015, [http://news.netcraft.com/archives/2014/07/31/july-2014-web-server-survey.html]</li>
						<li>Hall, S 2014, ScriptRock, IIS vs. Apache, accessed 29 July 2015, [http://www.scriptrock.com/articles/iis-apache]</li>
						<li>Mackie, K 2012, Redmond Magazine, Microsoft Touts IIS 8.0 Improvements on Windows Server 2012, accessed 29 July 2015, [http://redmondmag.com/articles/2012/08/15/microsoft-touts-iis-8-improvements.aspx]</li>
						<li>Microsoft 2014, IIS, Bit Rate Throttling, accessed 29 July 2015, [http://www.iis.net/downloads/microsoft/bit-rate-throttling]</li>
						<li>Vibish, P.V. 2014, Motifworks, Microsoft: 57% of Fortune 500 companies Using Azure, accessed 29 July 2015, [http://motifworks.com/microsoft-57-of-fortune-500-companies-using-azure/]</li>
						<li>Microsoft 2014, Microsoft Azure, Azure Pricing Calculator, accessed 29 July 2015, [http://azure.microsoft.com/en-us/pricing/calculator/?scenario=web]</li>
						<li>Microsoft 2014, Microsoft Azure, Virtual Machines Pricing Details, accessed 29 July 2015, [http://azure.microsoft.com/en-us/pricing/details/virtual-machines/]</li>
					</ul>
					<p class="orange-text">Wordcount: 1523</p>
				</div>
			</div>
		</div>
		
		<!-- Footer -->
		<?php include 'includes/footer.php' ?>
		<!-- end of Footer -->
	</body>
</html>