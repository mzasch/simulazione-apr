-- La codifica in linguaggio SQL delle seguenti interrogazioni:
--    a) elenco dei film in catalogo ordinati per genere ed anno di produzione;

SELECT Film.* -- oppure Film.Titolo, Film.Genere, Film.Anno
FROM Film
ORDER BY Film.Genere, Film.Anno;

--    b) elenco in ordine alfabetico degli utenti che non hanno mai visualizzato
--       alcun film;

SELECT DISTINCT Utenti.* -- oppure Utenti.Cognome, Utenti.Nome
FROM Utenti
  LEFT JOIN (
    SELECT Visualizza.CFUtente, COUNT(*) AS Film_Visualizzati
    FROM Visualizza
    GROUP BY Visualizza.CFUtente
  ) USING (Utenti.CF)
HAVING Film_Visualizzati = 0
ORDER BY Utenti.Cognome, Utenti.Nome;

SELECT DISTINCT Utenti.* -- oppure Utenti.Cognome, Utenti.Nome
FROM Utenti
WHERE Utenti.CF NOT IN (
  SELECT Utenti.CF
  FROM Utenti
    JOIN Visualizza ON Visualizza.CFUtente = Utenti.CF
  GROUP BY Utenti.CF
)
ORDER BY Utenti.Cognome, Utenti.Nome;


--    c) dato un intervallo di tempo tra due date, produrre il titolo che ha
--       registrato il maggior numero di visualizzazioni

SELECT Film.Titolo, COUNT(*) AS Visualizzazioni
FROM Film
  JOIN Visualizza ON Film.Id = Visualizza.IdFilm
WHERE Visualizza.DataVisualizza BETWEEN [DataInizio] AND [DataFine]
GROUP BY Film.Id;
