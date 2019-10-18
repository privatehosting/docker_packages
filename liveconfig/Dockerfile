FROM centos:latest

ENV LIVECONFIG_VERSION=2.8.4-r5653

RUN rpm --import https://www.liveconfig.com/liveconfig.key
RUN cd /etc/yum.repos.d ; curl -Os http://repo.liveconfig.com/centos/liveconfig.repo
RUN yum -y update
RUN yum -y install liveconfig-${LIVECONFIG_VERSION}.x86_64

EXPOSE 788 8080 8443	

ENTRYPOINT ["/usr/sbin/liveconfig", "-f"]
