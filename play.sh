docker stop mmi
docker rm mmi
docker run --name mmi -d -p 4000:80 mmi-hacking-game
docker ps
