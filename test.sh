docker stop mmi
docker rm mmi
docker run --name mmi -p 4000:80 mmi-hacking-game
docker ps
