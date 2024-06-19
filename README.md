
## build image
docker image rm -f reysie7e/pollash:qa
docker rm -f pollash
docker build -t reysie7e/pollash:qa .
## use this just in local
docker compose build pollash
docker-compose up -d 
docker exec -it pollash bash
cp -r resources/ public/build/assets/

## run container
docker push reysie7e/pollash:qa
docker container run -p 8001:8001 -d --network microservicesnetwork  --name pollash  reysie7e/pollash:qa


## run container production
docker image rm -f reysie7e/pollash:pro
docker push reysie7e/pollash:pro
docker container run -p 8001:8001 -d --network microservicesnetwork  --name pollash  reysie7e/pollash:pro