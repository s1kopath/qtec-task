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
