# liveconfig
DockerHub for Liveconfig (latest-stable-release)

# Docker commands
## create
```
docker pull dpilichiewicz/liveconfig:latest
docker run --name liveconfig -p 788:788/tcp -p 8080:8080/tcp -p 8443:8443/tcp -it dpilichiewicz/liveconfig:latest --activate
(Enter Key) & Press Enter
docker start liveconfig
```


## activate
```
docker exec -it liveconfig /bin/bash
/usr/bin/liveconfig --activate
(Enter Key) & Press Enter
```

