Attore(Id, Nome, Cognome)
Film(Id, Titolo, Anno, Genere, Trailer, Trama, Durata[, nVisualizzazioni])
Utente(CF, Username, Password[, nFilmVisti])
Visualizza(IdFilm, CFUtente, DataVisualizza)

DELIMITER $$

CREATE TRIGGER IncrementaView
  AFTER INSERT ON Visualizza FOR EACH ROW
  BEGIN
    UPDATE Film SET nVisualizzazioni = nVisualizzazioni + 1
      WHERE Film.Id = NEW.IdFilm;
  END$$

CREATE TRIGGER DecrementaView
  AFTER DELETE ON Visualizza FOR EACH ROW
  BEGIN
    UPDATE Film SET nVisualizzazioni = nVisualizzazioni - 1
      WHERE Film.Id = OLD.IdFilm;
  END$$
