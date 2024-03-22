import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
dayjs.extend(relativeTime);

const formatPublishedDate = (date) => {
    return dayjs(date).fromNow();
};

export { formatPublishedDate };
