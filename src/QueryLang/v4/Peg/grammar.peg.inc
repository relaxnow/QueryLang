Query: (Term | QuotedTerm) > Query*
QuotedTerm: Modifier* " TermValue+ "
Term: Modifier* TermValue
Modifier: /[+-]/
TermValue: /[\w\d]+/