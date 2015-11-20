<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<!-- HEADER -->
<head>
	<!-- Set-up important tags + load css -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Enzyme Finder</title>
	<meta name="robots" content="index" />
	<meta name="author" content="Ben" />
	<!--<link rel="stylesheet" type="text/css" href="main.css" media="screen" />-->

	<!-- Startup -->
	<script type="text/javascript">

		// Startup
		var enzymeList = [];
		var outputList = [];
		window.onload = startUp;

		// Startup Function
		function startUp() {
			// Define Global Variables
			defineVariables();
		}

		// Define Variables
		function defineVariables() {
			enzymeList = ["AatII", "GACGTC", "Acc65I", "GGTACC", "MluI", "ACGCGT", "MfeI", "CAATTG", "Acc65I", "GGTACC", "MluI", "ACGCGT", "MscI", "TGGCCA", "AclI", "AACGTT", "AfeI", "AGCGCT", "NaeI", "GCCGGC", "AflII", "CTTAAG", "NarI", "GGCGCC", "AgeI", "ACCGGT", "NcoI", "CCATGG", "ApaI", "GGGCCC", "NdeI", "CATATG", "ApaLI", "GTGCAC", "NgoMIV", "GCCGGC", "NheI", "GCTAGC", "AscI", "GGCGCGCC", "NotI", "GCGGCCGC", "AseI", "ATTAAT", "NruI", "TCGCGA", "AsiSI", "GCGATCGC", "NsiI", "ATGCAT", "AvrII", "CCTAGG", "BamHI", "GGATCC", "PacI", "TTAATTAA", "BclI", "TGATCA", "PciI", "ACATGT", "BglII", "AGATCT", "PmeI", "GTTTAAAC", "PmlI", "CACGTG", "BmtI", "GCTAGC", "PsiI", "TTATAA", "PspOMI", "GGGCCC", "PstI", "CTGCAG", "BsiWI", "CGTACG", "PvuI", "CGATCG", "BspEI", "TCCGGA", "PvuII", "CAGCTG", "BspHI", "TCATGA", "SacI", "GAGCTC", "BsrGI", "TGTACA", "SacII", "CCGCGG", "BssHII", "GCGCGC", "SalI", "GTCGAC", "BstBI", "TTCGAA", "SbfI", "CCTGCAGG", "BstZ17I", "GTATAC", "ScaI", "AGTACT", "ClaI", "ATCGAT", "SfoI", "GGCGCC", "DraI", "TTTAAA", "SmaI", "CCCGGG", "EagI", "CGGCCG", "EcoRI", "GAATTC", "SnaBI", "TACGTA", "EcoRV", "GATATC", "SpeI", "ACTAGT", "FseI", "GGCCGGCC", "SphI", "GCATGC", "FspI", "TGCGCA", "SspI", "AATATT", "StuI", "AGGCCT", "SwaI", "ATTTAAAT", "HindIII", "AAGCTT", "XbaI", "TCTAGA", "HpaI", "GTTAAC", "XhoI", "CTCGAG", "KasI", "GGCGCC", "XmaI", "CCCGGG", "KpnI", "GGTACC"];
			outputList = ["AatII", "", "Acc65I", "", "MluI", "", "MfeI", "", "Acc65I", "", "MluI", "", "MscI", "", "AclI", "", "AfeI", "", "NaeI", "", "AflII", "", "NarI", "", "AgeI", "", "NcoI", "", "ApaI", "", "NdeI", "", "ApaLI", "", "NgoMIV", "", "NheI", "", "AscI", "", "NotI", "", "AseI", "", "NruI", "", "AsiSI", "", "NsiI", "", "AvrII", "", "BamHI", "", "PacI", "", "BclI", "", "PciI", "", "BglII", "", "PmeI", "", "PmlI", "", "BmtI", "", "PsiI", "", "PspOMI", "", "PstI", "", "BsiWI", "", "PvuI", "", "BspEI", "", "PvuII", "", "BspHI", "", "SacI", "", "BsrGI", "", "SacII", "", "BssHII", "", "SalI", "", "BstBI", "", "SbfI", "", "BstZ17I", "", "ScaI", "", "ClaI", "", "SfoI", "", "DraI", "", "SmaI", "", "EagI", "", "EcoRI", "", "SnaBI", "", "EcoRV", "", "SpeI", "", "FseI", "", "SphI", "", "FspI", "", "SspI", "", "StuI", "", "SwaI", "", "HindIII", "", "XbaI", "", "HpaI", "", "XhoI", "", "KasI", "", "XmaI", "", "KpnI", ""];
		}

		function inform(){
			var sequenceValue = document.getElementById('searchSequence').value;
			var AASequence = getAASequence(sequenceValue);
			console.log(AASequence);
			var base=0;

			while (base <= 3) {
				var index=0;

				while (index < sequenceValue.length) {
					if (base == 0) {var letter="A";} else if (base == 1) {var letter="T";} else if (base == 2) {var letter="C";} else if (base == 3) {var letter="G";}
					var testValue = setCharAt(sequenceValue,index,letter);
					var AATest = getAASequence(testValue);
					var x=1;

					if (testValue !== sequenceValue && AATest == AASequence) {

						while (x < enzymeList.length) {
							var reg = new RegExp(enzymeList[x], 'g');
							var count = testValue.match(reg);
							var countStart = sequenceValue.match(reg);
							if (countStart == null) {
								//console.log("start: "+countStart+" count: "+count.length);
								if (count !== null) {
									//console.log(enzymeList[x-1]+": "+count.length+" ("+index+": "+letter+")");
									outputList[x] = outputList[x]+"("+(index+1)+":"+letter+") "
								}
							} else if (countStart !== null && count !== null) {
								if (count.length > countStart.length) {
									outputList[x] = outputList[x]+"("+(index+1)+":"+letter+") "
								}
							}
							x=x+2;
						}
					}

					index=index+1;
				}

				base=base+1;
			}

			var x=1;
			while (x < enzymeList.length) {
				if (outputList[x] !== "") {
					document.getElementById("outputText").innerHTML = document.getElementById("outputText").innerHTML + outputList[x-1] + "<br>" + outputList[x] + "<br><br>";
				}
				x=x+2;
			}
		}

		function setCharAt(str,index,chr) {
			if(index > str.length-1) return str;
			return str.substr(0,index) + chr + str.substr(index+1);
		}

		function getAASequence(str) {
			var x=0;
			var AAOutput="";
			while (x < str.length) {
				if (str.substring(x,x+3) == "ATG") {
					AAOutput = AAOutput + "M";
				} else if (str.substring(x,x+3) == "TTT" || str.substring(x,x+3) == "TTC") {
					AAOutput = AAOutput + "F";
				} else if (str.substring(x,x+3) == "TTA" || str.substring(x,x+3) == "TTG") {
					AAOutput = AAOutput + "L";
				} else if (str.substring(x,x+3) == "CTT" || str.substring(x,x+3) == "CTC" || str.substring(x,x+3) == "CTA" || str.substring(x,x+3) == "CTG") {
					AAOutput = AAOutput + "L";
				} else if (str.substring(x,x+3) == "ATT" || str.substring(x,x+3) == "ATC" || str.substring(x,x+3) == "ATA") {
					AAOutput = AAOutput + "I";
				} else if (str.substring(x,x+3) == "GTT" || str.substring(x,x+3) == "GTC" || str.substring(x,x+3) == "GTA" || str.substring(x,x+3) == "GTG") {
					AAOutput = AAOutput + "V";
				} else if (str.substring(x,x+3) == "TCT" || str.substring(x,x+3) == "TCC" || str.substring(x,x+3) == "TCA" || str.substring(x,x+3) == "TCG") {
					AAOutput = AAOutput + "S";
				} else if (str.substring(x,x+3) == "CCT" || str.substring(x,x+3) == "CCC" || str.substring(x,x+3) == "CCA" || str.substring(x,x+3) == "CCG") {
					AAOutput = AAOutput + "P";
				} else if (str.substring(x,x+3) == "ACT" || str.substring(x,x+3) == "ACC" || str.substring(x,x+3) == "ACA" || str.substring(x,x+3) == "ACG") {
					AAOutput = AAOutput + "T";
				} else if (str.substring(x,x+3) == "GCT" || str.substring(x,x+3) == "GCC" || str.substring(x,x+3) == "GCA" || str.substring(x,x+3) == "GCG") {
					AAOutput = AAOutput + "A";
				} else if (str.substring(x,x+3) == "TAT" || str.substring(x,x+3) == "TAC") {
					AAOutput = AAOutput + "Y";
				} else if (str.substring(x,x+3) == "TAA" || str.substring(x,x+3) == "TAG" || str.substring(x,x+3) == "TGA") {
					AAOutput = AAOutput + "[STOP]";
				} else if (str.substring(x,x+3) == "CAT" || str.substring(x,x+3) == "CAC") {
					AAOutput = AAOutput + "H";
				} else if (str.substring(x,x+3) == "CAA" || str.substring(x,x+3) == "CAG") {
					AAOutput = AAOutput + "Q";
				} else if (str.substring(x,x+3) == "AAT" || str.substring(x,x+3) == "AAC") {
					AAOutput = AAOutput + "N";
				} else if (str.substring(x,x+3) == "AAA" || str.substring(x,x+3) == "AAG") {
					AAOutput = AAOutput + "K";
				} else if (str.substring(x,x+3) == "GAT" || str.substring(x,x+3) == "GAC") {
					AAOutput = AAOutput + "D";
				} else if (str.substring(x,x+3) == "GAA" || str.substring(x,x+3) == "GAG") {
					AAOutput = AAOutput + "E";
				} else if (str.substring(x,x+3) == "TGT" || str.substring(x,x+3) == "TGC") {
					AAOutput = AAOutput + "C";
				} else if (str.substring(x,x+3) == "TGG") {
					AAOutput = AAOutput + "W";
				} else if (str.substring(x,x+3) == "CGT" || str.substring(x,x+3) == "CGC" || str.substring(x,x+3) == "CGA" || str.substring(x,x+3) == "CGG") {
					AAOutput = AAOutput + "R";
				} else if (str.substring(x,x+3) == "AGT" || str.substring(x,x+3) == "AGC") {
					AAOutput = AAOutput + "S";
				} else if (str.substring(x,x+3) == "AGA" || str.substring(x,x+3) == "AGG") {
					AAOutput = AAOutput + "R";
				} else if (str.substring(x,x+3) == "GGT" || str.substring(x,x+3) == "GGC" || str.substring(x,x+3) == "GGA" || str.substring(x,x+3) == "GGG") {
					AAOutput = AAOutput + "G";
				} else {
					AAOutput = AAOutput + "X";
				}
				x=x+3;
			}
			return AAOutput;
		}

	</script>
</head>

<!-- BODY -->
<body>
	<div id="centerBox" align="center">
		This application will search a cDNA sequence for ALL common restriction enzyme sites that could potentially exist without affecting the amino acid sequence.<br>
		Simply paste your cDNA into the search box in frame (5’-ATG…TAG-3’) and click Search.<br>
		After a brief pause a list of the possible restriction enzyme sites will be generated showing the mutations needed to create these sites in the following format:
		<br><br>
		(##:X)
		<br><br>
		Where ## is the location of the nucleotide in the sequence and X is the nucleotide (A, T, C or G) to be substituted in order to generate the new restriction site without altering the amino acid sequence.
		<br><br>
		<textarea type="text" id="searchSequence" cols="150" rows="15"></textarea>
		<br>
		<input type="button" value="Search" align="center" onclick="inform()">
		<br><br>
		<div id="outputText" align="center"></div>
	</div>
</body>
