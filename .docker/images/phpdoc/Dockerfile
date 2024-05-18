ARG VALUE_PHPDOC_VERSION
ARG DEF_PHPDOC_VERSION=${VALUE_PHPDOC_VERSION:-"3.4"}

FROM phpdoc/phpdoc:${DEF_PHPDOC_VERSION}

ARG PHPDOC_FOLDER_PROJECT
ENV PHPDOC_FOLDER_PROJECT=${PHPDOC_FOLDER_PROJECT:-"/usr/local/apache2/www/"}
ARG PHPDOC_FOLDER_DOC
ENV PHPDOC_FOLDER_DOC=${PHPDOC_FOLDER_DOC:-"/usr/local/apache2/docs/"}
ENV PHPDOC_FOLDER_LOG="/var/log/docker/phpdoc/"
ENV PHPDOC_FOLDER_TMP="/var/tmp/docker/phpdoc/"
ENV PHPDOC_FOLDER_INI="/var/docker/phpdoc/"

RUN mkdir -p ${PHPDOC_FOLDER_PROJECT}
RUN mkdir -p ${PHPDOC_FOLDER_DOC}
RUN mkdir -p ${PHPDOC_FOLDER_LOG}
RUN mkdir -p ${PHPDOC_FOLDER_TMP}
RUN mkdir -p ${PHPDOC_FOLDER_INI}

COPY phpdoc.xml ${PHPDOC_FOLDER_INI}/

RUN ln -s /opt/phpdoc/bin/phpdoc /usr/bin/phpdoc

RUN echo '#!/bin/bash' > /usr/bin/docker-phpdoc-entrypoint.sh
RUN echo ' -h > /var/log/docker/phpdoc/stratphpdoc.log' >> /usr/bin/docker-phpdoc-entrypoint.sh
RUN echo 'exec "$@"' >> /usr/bin/docker-phpdoc-entrypoint.sh
RUN chmod 777 /usr/bin/docker-phpdoc-entrypoint.sh

WORKDIR ${PHPDOC_FOLDER_INI}

ENTRYPOINT ["docker-phpdoc-entrypoint.sh"]

CMD /bin/bash ; sleep infinity
