@extends('layouts.site')

@section('content')

<div class="tag-view view-siteconfigs tag-index">

    <section class="row"> 

        <article class="col-md-12">

            <section class="row">
                <article class="col-md-12">
                    <h1>Messages</h1>
                </article>
            </section>

            <section class="row">
                <article class="col-md-9">
                    @include('site.plupload._mediafilePluForm')
                </article>
            </section>

        </article>

    </section>


@endsection
