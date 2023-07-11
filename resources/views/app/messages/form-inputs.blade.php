@php $editing = isset($message) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="body" label="Body" maxlength="255" required
            >{{ old('body', ($editing ? $message->body : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $message->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="phone"
            label="Phone"
            {{-- :value="old('phone', ($editing ? $message->phone : ''))" --}}
            value="{{ old('phone', ($editing ? $message->user->phone : '')) }}"
            maxlength="255"
            placeholder="Phone"
        ></x-inputs.text>
    </x-inputs.group>

    @if(Auth::user()->hasRole('developer'))
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="send_status" label="Send Status">
            @php $selected = old('send_status', ($editing ? $message->send_status : '0')) @endphp
            <option value="0" {{ $selected == '0' ? 'selected' : '' }} >0</option>
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >1</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >2</option>
            <option value="3" {{ $selected == '3' ? 'selected' : '' }} >3</option>
            <option value="4" {{ $selected == '4' ? 'selected' : '' }} >4</option>
        </x-inputs.select>
    </x-inputs.group>
    @else 
    <x-inputs.hidden name="send_status" :value="old('send_status', ($editing ? $message->send_status : '0'))"></x-inputs.hidden>
    @endif

     @if(Auth::user()->hasRole('developer'))
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="type" label="Type">
            @php $selected = old('type', ($editing ? $message->type : '1')) @endphp
            <option value="0" {{ $selected == '0' ? 'selected' : '' }} >0</option>
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >1</option>
        </x-inputs.select>
    </x-inputs.group>
    @else
    <x-inputs.hidden name="type" :value="old('type', ($editing ? $message->type : '1'))"></x-inputs.hidden>
    @endif
</div>
