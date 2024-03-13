const FormatDate = (date) => {
  if (!date) {
    return '-';
  }

  const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
  const formattedDate = new Date(date).toLocaleDateString(undefined, options);
  return formattedDate;
};

export default FormatDate;
