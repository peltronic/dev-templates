@extends('layouts.site')

@section('content')
<div class="view-home tag-view">

<section class="row supercrate-header">
    <article class="small-12 columns">
        <h1>Peter S. Gorgone</h1>
        <h2>Expert Web and Application Developer</h2>
    </article>
</section>

<section class="row supercrate-body">
    <article class="small-12 columns">
        <img id="pic-peter" class="show-for-medium-up" src="/images/peter_expert_web_developer.jpg" style="max-width: 220px" align="right" alt="Peter's Expert Web Developer Profile Picture">
        <p>
            Hello, and thank you for visiting. I'm a freelance web developer with over 8 years experience developing and maintaing PHP-based websites. I cover the "full stack", meaning all aspects of a site ranging from the server &amp; database configuration to the front-end Javascript and CSS code.
        </p>
        <p>
        If you are a small business or start-up looking for a developer to work with - who is capable of complex programming and solving challenging problems -- please feel free to contact me at (424) 241-9327.
        </p>
        <div class="superbox-benefits_list">
            <ul>
                <li><i class="fa fa-plus"></i>Twenty-plus years programming experience</li>
                <li><i class="fa fa-plus"></i>Masters Degree in Electrical Engineering</li>
                <li><i class="fa fa-plus"></i>Mobile-Friendly Design</li>
                <li><i class="fa fa-plus"></i>Business, SEO, &amp; Technical Consulting</li>
                <li><i class="fa fa-plus"></i>Agile Development Practices</li>
            </ul>
        </div>
        <h3>How my Career Began</h3>
        <p>
        My first experience coding was in the mid-80s, when a friend would come over after school and we'd boot-up my Commodore-64, attach it to the TV, and code away together in BASIC. Our first working program was a text-based 'football' simulator, where you could choose between running and passing places, and yardage was randomly selected. The challenge and fun of conceiving an idea, and figuring out how to evolve it into working software immediately hooked me on programming.
        </p>
        <p>A few years later in college at Wesleyan University, while helping my physics professor setup his new lab, I taught myself UNIX and C to write programs to analyze experiment data. After graduate school I was hired by Silicon Graphics, where I was able to apply not only my C coding skills, but learned to work with a large team of engineers to design &amp; build sophisticated graphics processing chips.
        </p>
    </article>
    <article class="small-12 columns">
        {!! $contents['home-page-1'] !!}
    </article>
</section>

</div>

@stop
