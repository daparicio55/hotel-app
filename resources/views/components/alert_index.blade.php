<div>
    @session('success')
    <x-adminlte-alert class="bg-success text-uppercase" icon="fa fa-thumbs-up" title="Hecho" dismissable>
        <strong>Genial!</strong> {{ session('success') }}
    </x-adminlte-alert>
    @endsession
    @session('error')
        <x-adminlte-alert class="bg-danger text-uppercase" icon="fas fa-exclamation-circle" title="Error" dismissable>
            <strong>Ups!</strong> {{ session('error') }}
        </x-adminlte-alert>
    @endsession
</div>