@foreach ($agenda as $data)

<div class="row mt-3">
    <div class="col-md-12">

        <table class="table table-striped">
            {{-- <thead>
                <th class="topicth">Topic</th>
                <th class="desccolor">Description</th>
            </thead> --}}
            <tbody>
                <tr>
                    <td class="colortd topicth">Action:</td>
                    <td ><a style="color: black;" href="{{ route('TicketView', ['id' => $data->id]) }}">{{$data->subject}}</a></td>

                </tr>
                <tr>
                    <td class="colortd topicth">Action By:</td>
                    <td>{{$data->agenda_dev}}</td>
                </tr>
                <tr>
                    <td class="colortd topicth done">Done:</td>
                    <td><input id="done" class="done-check" data-id="{{$data->id}}" type="checkbox" {{ $data->agenda_done == 1 ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <td class="colortd topicth notesd">Notes:</td>
                    <td style="display: flex; align-items: center;"><input id="notes" class="form-control" data-id="{{$data->id}}" type="text" value="{{ !empty($data->agenda_notes) ? $data->agenda_notes : '' }}"><button class='btn btn-info ml-1 ' id="savenotes">
                        Save</button></td>
                </tr>
            </tbody>
        </table>


</div>
</div>
@endforeach
