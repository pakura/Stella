sudo apt-get update
sudo apt-get install apt-transport-https ca-certificates curl software-properties-common
sudo apt install containerd

sudo apt-get install docker.io
sudo docker-compose build && docker-compose up -d
docker exec app composer install
docker exec app cp .env.example .env
docker exec app php artisan key:generate
docker exec app php artisan migrate
docker exec app php artisan db:seed
