@servers(['aws' => '-i D:\\espagodev\dev.pem ubuntu@ec2-3-131-101-33.us-east-2.compute.amazonaws.com','localhost' => '127.0.0.1'])
{{-- @servers([ 'aws' => ['ubuntu@3.18.107.107']]) --}}
{{-- envoy run git:clone --on=aws --}}
{{-- envoy run git:pull --on=aws --}}
@include('vendor/autoload.php')

@setup
    // $origin = 'https://espagodev:Y7323529KespG%40@github.com/espagodev/lotogam_espagodev_com.git';
     $origin = 'https://espagodev:Y7323529KespG%40@github.com/espagodev/lotogam.espagodev.com.git';
    $branch = isset($branch) ? $branch : 'master';
    $app_dir1 = '/var/www';
    $app_dir = '/var/www/lotogam.espagodev.com';

    if ( !isset($on)) {
        throw new Exception('La variable --on no está definida');
    }
@endsetup

@macro('app:deploy', ['on' => $on])
    down
    git:pull
    migrate
    composer:install
    assets:install
    cache:clear
    up
@endmacro

@task('test')
    echo "Prueba Envoy";
@endtask

@task('git:clone', ['on' => $on])
    cd {{ $app_dir1 }}
    echo "hemos entrado al directorio /var/www";
    git clone {{ $origin }};
    echo "repositorio clonado correctamente";
@endtask

@task('renombrar', ['on' => $on])
    cd {{ $app_dir1 }}
    echo "hemos entrado al directorio /var/www";
     mv lotogam_espagodev_com lotogam.espagodev.com
    echo "carpeta renombrada correctamente";
@endtask

@task('git:pull', ['on' => $on])
    cd {{ $app_dir }}
    echo "hemos entrado al directorio {{ $app_dir }}";
    git pull origin {{ $branch }}
    echo "código actualizado correctamente";
@endtask

@task('git:checkout', ['on' => $on])
    cd {{ $app_dir }}
    echo "hemos entrado al directorio {{ $app_dir }}";

    git stash save              {{ $branch }}
    {{-- git merge origin/{{ $branch }} --}}
    git stash pop               {{ $branch }}

    {{-- git checkout -- app/Traits/InteractsWithmarketResponses.php {{ $branch }} --}}
    echo "código actualizado correctamente";
@endtask

@task('ls', ['on' => $on])
    cd {{ $app_dir }}
    ls -la
@endtask


@task('composer:install', ['on' => $on])
    cd {{ $app_dir }}
    composer install
@endtask

@task('composer:autoload', ['on' => $on])
    cd {{ $app_dir }}
    composer dump-autoload
@endtask

@task('env', ['on' => $on])
    cd {{ $app_dir }}
    sudo  cp .env.example .env
    echo "Se crea archivo env";
@endtask

@task('key:generate', ['on' => $on])
    cd {{ $app_dir }}
    sudo php artisan key:generate
@endtask

@task('migrate', ['on' => $on])
    cd {{ $app_dir }}
    php artisan migrate
    sudo php artisan migrate:refresh --seed
@endtask

@task('permiso:storage', ['on' => $on])
    cd {{ $app_dir }}
    sudo chown -R www-data storage/
     echo "Se dieron permisos a storage";
@endtask

@task('permiso:bootstrap', ['on' => $on])
    cd {{ $app_dir }}
    sudo chown -R www-data bootstrap/cache/
     echo "Se dieron permisos a bootstrap";
@endtask

@task('assets:install', ['on' => $on])
    cd {{ $app_dir }}
    yarn install
@endtask

@task('up', ['on' => $on])
    cd {{ $app_dir }}
    php artisan up
@endtask

@task('down', ['on' => $on])
    cd {{ $app_dir }}
    php artisan down
@endtask

@task('cache', ['on' => $on])
    cd {{ $app_dir }}
    php artisan config:cache
    php artisan cache:clear
    echo "caché limpiada correctamente";
@endtask
