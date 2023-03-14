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
                                        <input class="form-check-input" type="checkbox" name="keywords[]"
                                            value="{{ $keyword['keyword'] }}" id="{{ $keyword['keyword'] }}"
                                            {{ in_array($keyword['keyword'], $selectedKeywords) ? 'checked' : '' }}>
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
                                        <input class="form-check-input" type="checkbox" name="users[]"
                                            value="{{ $user->user_name }}" id="user-{{ $user->user_name }}"
                                            {{ in_array($user->user_name, $selectedUsers) ? 'checked' : '' }}>
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
                                        value="{{ isset($_GET['start_date']) ? $_GET['start_date'] : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date"
                                        value="{{ isset($_GET['end_date']) ? $_GET['end_date'] : '' }}">
                                </div>
                                <div class="d-flex justify-content-between my-2">
                                    <a href="{{ route('home') }}" class="btn btn-danger">Reset Filters</a>
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="col-md-12 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Keyword</th>
                                <th scope="col">Search Time</th>
                                <th scope="col" width="500px">Search Results</th>
                                <th scope="col">Total Results</th>
                                <th scope="col">Search Engine</th>
                                <th scope="col">Search Type</th>
                                <th scope="col">User's Name</th>
                                <th scope="col">Ip Address</th>
                                <th scope="col">Device Type</th>
                                <th scope="col">Browser Type</th>
                                <th scope="col">Language</th>
                                <th scope="col">Clicked Result</th>
                                <th scope="col">Time Spent</th>
                                <th scope="col">Section Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($searches as $key => $data)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $data->keyword }}</td>
                                    <td>{{ $data->search_time }}</td>
                                    <td>
                                        @foreach (json_decode($data->search_results) as $result)
                                            <strong>Title:</strong> {{ $result->title }}
                                            <br>
                                            <a href="{{ $result->url }}">{{ $result->url }}</a>
                                            <br>
                                        @endforeach
                                    </td>
                                    <td>{{ $data->total_results }}</td>
                                    <td>{{ $data->search_engine }}</td>
                                    <td>{{ $data->search_type }}</td>
                                    <td>{{ $data->user_name }}</td>
                                    <td>{{ $data->ip_address }}</td>
                                    <td>{{ $data->device_type }}</td>
                                    <td>{{ $data->browser_type }}</td>
                                    <td>{{ $data->language }}</td>
                                    <td>{{ $data->clicked_result }}</td>
                                    <td>{{ $data->time_spent }}</td>
                                    <td>{{ $data->is_section_active }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        {{ $searches->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="https://getbootstrap.com/docs/5.3/examples/dashboard/dashboard.js"></script>
</body>

</html>
