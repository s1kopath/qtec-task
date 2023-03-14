<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Qtec</title>

    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="manifest" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="icon" href="https://www.qtecsolution.com/static/homepage/assets/images/favicon.svg">

    <link href="https://getbootstrap.com/docs/5.3/examples/dashboard/dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Qtec</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky p-3 sidebar-sticky">
                    <form method="GET" action="{{ route('home') }}">
                        <div class="">
                            <div class="col-md-12">
                                <h3>All Keywords:</h3>
                                @foreach ($keywords as $keyword)
                                    <div class="form-check">
                                        <input class="form-check-input keyword-checkbox" type="checkbox"
                                            name="keywords[]" value="{{ $keyword['keyword'] }}"
                                            id="{{ $keyword['keyword'] }}" {{-- {{ in_array($keyword['keyword'], $selectedKeywords) ? 'checked' : '' }} --}}>
                                        <label class="form-check-label" for="{{ $keyword }}">
                                            {{ $keyword['keyword'] }} ({{ $keyword['count'] }} times found)
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-md-12">
                                <h3>All Users:</h3>
                                @foreach ($users as $user)
                                    <div class="form-check">
                                        <input class="form-check-input user-checkbox" type="checkbox" name="users[]"
                                            value="{{ $user->user_name }}" id="user-{{ $user->user_name }}"
                                            {{-- {{ in_array($user->user_name, $selectedUsers) ? 'checked' : '' }} --}}>
                                        <label class="form-check-label" for="user-{{ $user->user_name }}">
                                            {{ $user->user_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-12">
                                <h3>Time Range:</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="yesterday" value="1"
                                        id="yesterday" {{ isset($_GET['yesterday']) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="yesterday">
                                        See data from yesterday
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="last_week" value="1"
                                        id="last_week" {{ isset($_GET['last_week']) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="last_week">
                                        See data from last week
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="last_month" value="1"
                                        id="last_month" {{ isset($_GET['last_month']) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="last_month">
                                        See data from last month
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date"
                                        value="">
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date"
                                        value="">
                                </div>
                                <div class="d-flex justify-content-between my-2">
                                    <a href="{{ route('home') }}" class="btn btn-danger">Reset Filters</a>
                                    <button type="button" class="btn btn-primary" onclick="fetch_data()">
                                        Apply Filters
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="table-data">
                {{-- @include('data') --}}
            </main>
        </div>
    </div>

    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="https://getbootstrap.com/docs/5.3/examples/dashboard/dashboard.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            fetch_data();
        });
        
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function get_users() {
            _users = [];
            i = 0;
            $('.user-checkbox:checked').each(function() {
                _users[i] = this.value;
                i++;
            });

            return _users;
        }

        function get_keywords() {
            _keywords = [];
            j = 0;
            $('.keyword-checkbox:checked').each(function() {
                _keywords[j] = this.value;
                j++;
            });

            return _keywords;
        }

        function fetch_data(page = 1) {
            $.ajax({
                url: "/fetch-data?page=" + page,
                type: "GET",
                data: {
                    keywords: get_keywords(),
                    users: get_users(),
                    yesterday: $('#yesterday').is(":checked") ? 1 : "",
                    last_week: $('#last_week').is(":checked") ? 1 : "",
                    last_month: $('#last_month').is(":checked") ? 1 : "",
                    start_date: $('#start_date').val() ?? "",
                    end_date: $('#end_date').val() ?? "",
                },
                success(response) {
                    $('#table-data').html(response);
                }
            });

        }
    </script>
</body>

</html>
