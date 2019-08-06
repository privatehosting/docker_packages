# Teamspeak in Docker
Binary Files in /opt/teamspeak

Install (amd64) 
`docker run --name teamspeak -p 30033:30033 -p 9987:9987/udp -p 10011:10011 dpilichiewicz/teamspeak:latest`

Install (x86) 
`docker run --name teamspeak -p 30033:30033 -p 9987:9987/udp -p 10011:10011 dpilichiewicz/teamspeak:latest-x86`