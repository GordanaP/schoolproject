@extends('layouts.app')

@section('links')
    <style>
        body { background: #f9f9f9 }
        .navbar-inverse { background: #9ccc65!important; border-top: 6px solid #6b9b37; border-bottom: none}
        .lecture-title { padding: 10px; background: #424242; border-bottom: 1px solid #fff; }
        .lecture-title h1 { margin: 0; color: #fff}
        .active { background: #ffee58 !important; border-color: #ffee58 !important; font-size: 16px; color: #212121 !important}
        .list-group-item {border-bottom: #eee !important; background: #f1f1f1; color: #212121 !important;}
        .badge {background: #424242!important;}

        div#firstYear{ border: 1px solid #ddd }
        div#firstYear ul{ margin: 0; }
        div#firstYear ul li { padding: 4px }
        div#firstYear ul li a { color: #888888; margin: 4px }

        main#createLecture{background: #fff; border: 1px solid #eee; padding: 18px; color: #212121}
        /*section.lecture__info {padding: 10px; background: #f1f8e9; margin-bottom: 10px}*/
        section#subject.lecture__info {padding: 10px; background: #424242; margin-bottom: 12px; color: #fff;}
        section#general.lecture__info .panel-heading,
        section#materials.lecture__info .panel-heading {background: #fff176; padding-bottom: 8px; padding-top: 8px;}
        section#general.lecture__info .panel-body,
        section#materials.lecture__info .panel-body {background: #f5f5f6}

        select, button, input, textarea, .panel{ border-radius: 0 !important; border: 1px solid #eee}
        .form-group{margin-bottom: 18px !important;}
        .ls-2{ letter-spacing: 2px }
    </style>
@endsection

@section('content')

    <main id="createLecture">
        <form action="{{ route('lectures.store', $user) }}" method="POST">

            {{ csrf_field() }}

            <section class="lecture__info" id="subject">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select class="form-control" name="subject" id="subject">
                                <option selected="" disabled="">Select a subject</option>
                                <option value="1">Subject 1</option>
                                <option value=2>Subject 2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="year">Academic year</label>
                            <select class="form-control" name="year" id="year">
                                <option selected="" disabled="">Select a year</option>
                                <option value="1">First year</option>
                                <option value="2">Second year</option>
                            </select>
                        </div>
                    </div>
                </div>
            </section>

            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background: #424242; color: #fff">
                            My portfolio
                        </div>
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <section class="lecture__info" id="general">
                        <div class="panel">
                            <div class="panel-heading text-uppercase ls-2">
                                General
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Lecture title">
                                </div>

                                <div class="form-group">
                                    <label for="topic">Topic</label>
                                    <input type="text" class="form-control" name="topic" id="topic" value="{{ old('topic') }}" placeholder="Lecture topic">
                                </div>

                                <div class="form-group">
                                    <label for="goals">Goals</label>
                                    <textarea class="form-control" name="goals" id="goals" rows="4" placeholder="Lecture goals">{{ old('goals') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="lecture__info" id="materials">
                            <div class="panel">
                                <div class="panel-heading text-uppercase ls-2">
                                    MATERIALS
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="readings">Readings</label>
                                        <input type="text" class="form-control" name="readings" id="readings" value="{{ old('readings') }}" placeholder="Readings">
                                    </div>
                                    <div class="form-group">
                                        <label for="practice">Practice</label>
                                        <input type="text" class="form-control" name="practice" id="practice" value="{{ old('practice') }}" placeholder="Practice">
                                    </div>
                                    <div class="form-group">
                                        <label for="media">Media</label>
                                        <input type="text" class="form-control" name="media" id="media" value="{{ old('media') }}" placeholder="url">
                                    </div>
                                </div>
                            </div>
                    </section>

                    <button type="submit" class="btn btn-success pull-right">
                        Create lecture
                    </button>
                </div>
            </div>
        </form>
    </main>
@endsection