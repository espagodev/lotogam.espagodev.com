@servers(['aws' => '-i D:\\espagodev\dev.pem ubuntu@ec2-3-131-101-33.us-east-2.compute.amazonaws.com','localhost' => '127.0.0.1','lot' => '-i D:\\espagodev\LightsailDefaultKey-eu-west-3.pem ubuntu@15.237.141.99'])
{{-- @servers([ 'aws' => ['ubuntu@3.18.107.107']]) --}}
{{-- envoy run git:clone --on=aws --}}
{{-- envoy run git:pull --on=aws --}}
{{-- envoy run lot_pull --on=lot --}}
@include('vendor/autoload.php')

@setup
    $origin = 'git remote add origin https://espagodev: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@lotogam.espagodev.com.git';
    //  $origin = 'https://espagodev:Y7323529KespG%40@github.com/espagodev/lotogam.espagodev.com.git';
    // $origin = 'git clone https://github.com/espagodev/lotogam.espagodev.com.git
    //             Username: espagodev
    //             Password: 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';
    $branch = isset($branch) ? $branch : 'master';
    $app_dir1 = '/var/www';
    $app_dir = '/var/www/lotogam.espagodev.com';

    $app_dir_lotogam = '/var/www/lotogam.com';
    // $app_dir_lotogam = '/var/www/prueba.lotogam.com';

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
   sudo git clone {{ $origin }};
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
    sudo git pull origin {{ $branch }}
    echo "código actualizado correctamente";
@endtask

@task('origen', ['on' => $on])
    cd {{ $app_dir }}
    echo "hemos entrado al directorio {{ $app_dir }}";
    sudo git remote remove origin 
    sudo git remote add origin git@github.com:espagodev/lotogam.espagodev.com.git
    echo "origen actualizado correctamente";
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
    cd {{ $app_dir1 }}
    ls -la
@endtask

@task('composer', ['on' => $on])
    cd {{ $app_dir }}
  sudo  composer install
@endtask

@task('autoload', ['on' => $on])
    cd {{ $app_dir }}
  sudo  composer dump-autoload
@endtask

@task('env', ['on' => $on])
    cd {{ $app_dir }}
    sudo  cp .env.example .env
    echo "Se crea archivo env";
@endtask

@task('key', ['on' => $on])
    cd {{ $app_dir }}
    sudo php artisan key:generate
@endtask

@task('migrate', ['on' => $on])
    cd {{ $app_dir }}
   sudo php artisan migrate
    {{-- sudo php artisan migrate:refresh --seed --}}
@endtask

@task('storage', ['on' => $on])
    cd {{ $app_dir }}
    sudo chown -R www-data storage/
     echo "Se dieron permisos a storage";
@endtask

@task('bootstrap', ['on' => $on])
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
 sudo   php artisan config:cache
    {{-- php artisan cache:clear --}}
    echo "caché limpiada correctamente";
@endtask

@task('rm', ['on' => $on])
    cd {{ $app_dir_rm }}
    {{-- sudo rm -r {{ $app_dir_rm }} --}}

@endtask



{{-- LOTOGMA --}}

@task('lot_pull', ['on' => $on])
    cd {{ $app_dir_lotogam }}
    echo "hemos entrado al directorio {{ $app_dir_lotogam }}";
    {{-- sudo git pull origin {{ $branch }} --allow-unrelated-histories --}}
    sudo git pull origin {{ $branch }}
    echo "código actualizado correctamente";
@endtask

@task('lot_origen', ['on' => $on])
    cd {{ $app_dir_lotogam }}
    echo "hemos entrado al directorio {{ $app_dir_lotogam }}";
     {{-- sudo git fetch origin
    sudo git reset --hard origin/master  --}}
    sudo git remote remove origin 
    sudo git remote add origin git@github.com:espagodev/lotogam.espagodev.com.git
    echo "origen actualizado correctamente";
@endtask

@task('lot_ls', ['on' => $on])
    cd {{ $app_dir_lotogam }}
    ls -ln
@endtask

@task('lot_composer', ['on' => $on])
    cd {{ $app_dir_lotogam }}
  sudo  composer install --no-dev
@endtask

@task('lot_auto', ['on' => $on])
    cd {{ $app_dir_lotogam }}
  sudo  composer dump-autoload
@endtask

@task('lot_env', ['on' => $on])
    cd {{ $app_dir_lotogam }}
    sudo  cp .env.example .env
    echo "Se crea archivo env";
@endtask

@task('lot_key', ['on' => $on])
    cd {{ $app_dir_lotogam }}
    sudo php artisan key:generate
@endtask

@task('lot_migrate', ['on' => $on])
    cd {{ $app_dir_lotogam }}
    sudo php artisan migrate
    {{-- sudo php artisan migrate:refresh --seed --}}
@endtask

@task('lot_stor', ['on' => $on])
    cd {{ $app_dir_lotogam }}
    sudo chown -R www-data storage/
     echo "Se dieron permisos a storage";
@endtask

@task('lot_boot', ['on' => $on])
    cd {{ $app_dir_lotogam }}
    sudo chown -R www-data bootstrap/cache/
     echo "Se dieron permisos a bootstrap";
@endtask

@task('lot_cache', ['on' => $on])
    cd {{ $app_dir_lotogam }}
 sudo   php artisan config:cache
    {{-- php artisan cache:clear --}}
    echo "caché limpiada correctamente";
@endtask