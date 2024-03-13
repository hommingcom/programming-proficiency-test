const getDaysRange = (dateFrom, dateTo) => {
  if (!dateFrom) {
    return '-';
  }

  if (!dateTo) {
    return 'Indefinido';
  }

  const startDate = new Date(dateFrom);
  const endDate = new Date(dateTo);

  const timeDifference = endDate - startDate;
  const daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

  return daysDifference === 1 ? '1 Día' : `${daysDifference} días`;
};

export default getDaysRange;
